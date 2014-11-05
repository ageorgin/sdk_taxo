<?php

class Service {

  protected $idClient = null;
  protected $urlAPI = null;
  protected $accessToken = null;

  public function __construct($idClient, $urlAPI) {
    $this->idClient = $idClient;
    $this->urlAPI = $urlAPI;
  }

  public function getIdClient() {
    return $this->idClient;
  }

  public function setIdClient($idClient) {
    $this->idClient = $idClient;
    return $this;
  }

  public function getUrlAPI() {
    return $this->urlAPI;
  }

  public function setUrlAPI($urlAPI) {
    $this->urlAPI = $urlAPI;
    return $this;
  }

  public function getAccessToken() {
    return $this->accessToken;
  }

  public function setAccessToken($accessToken) {
    $this->accessToken = $accessToken;
    return $this;
  }

  public function connect() {
    if (empty($this->accessToken)) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->urlAPI . "/access_token");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, TRUE);
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, "");
      curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-FTVEN-ID: id: " . $this->idClient));
      $response = curl_exec($ch);
      $headers = Service::get_headers_from_curl_response($response);

      if (empty($headers)) {
        throw new Exception('Impossible de se connecter à l\'API Taxonomie');
      }

      $this->accessToken = $headers['X-FTVEN-ID'];
      curl_close($ch);
    }
  }

  /**
   * Retourne les headers d'une réponse et strip les réponses
   */
  static function get_headers_from_curl_response(&$response) {
    $headers = array();
    $arrRequests = explode("\r\n\r\n", $response);
    $response = $arrRequests[1];

    for ($index = 0; $index < count($arrRequests) - 1; $index++) {

      foreach (explode("\r\n", $arrRequests[$index]) as $i => $line) {
        if ($i === 0)
          $headers[$index]['http_code'] = $line;
        else {
          list ($key, $value) = explode(': ', $line, 2);
          $headers[$index][$key] = $value;
        }
      }
    }
    if (count($headers) == 1) {
      $headers = $headers[0];
    }
    return $headers;
  }

  static function addParamUrl($params = array()) {
    $url = '';
    $i = 0;

    foreach ($params as $key => $value) {
      if ($value) {
        $url .= (($i == 0) ? '?' : '&') . $key . '=' . rawurlencode($value);
        $i++;
      }
    }

    return $url;
  }

}
