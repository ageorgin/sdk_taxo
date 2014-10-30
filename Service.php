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
      $headers = TagService::get_headers_from_curl_response($response);

      $this->accessToken = $headers['X-FTVEN-ID'];
      curl_close($ch);
    }
  }

  static function get_headers_from_curl_response($headerContent) {
    $headers = array();
    $arrRequests = explode("\r\n\r\n", $headerContent);

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

  static function addParamUrl($sort = null, $page = null, $limit = null) {
    $url = '';
    $i = 0;

    if ($sort) {
      $url += (($i == 0) ? '?' : '&') . 'sort=' . $sort;
      $i++;
    }

    if ($page) {
      $url += (($i == 0) ? '?' : '&') . 'page=' . $page;
      $i++;
    }

    if ($limit) {
      $url += (($i == 0) ? '?' : '&') . 'limit=' . $limit;
      $i++;
    }
    return $url;
  }

}
