<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

class Service {

  protected $idClient = null;
  protected $urlAPI = null;
  protected $accessToken = null;

  public function __construct($idClient, $urlAPI) {
    $this->idClient = $idClient;
    $this->urlAPI = $urlAPI;
    $this->connect();
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
      $headers = array(
        'X-FTVEN-ID' => "id: " . $this->idClient,
      );

      $response = $this->sendPostRequest($this->urlAPI . "/access_token", array(), $headers);

      $x_ftven_id = $response->getHeader('X-FTVEN-ID')->raw();

      $this->accessToken = $x_ftven_id[0];
    }
  }

  protected function sendGetRequest($url, $param = array()) {
    $client = new Guzzle\Service\Client();

    $request = $client->get($url, $this->getHeaders());
    foreach ($param as $key => $value) {
      $request->getQuery()->add($key, $value);
    }

    $response = $request->send();

    return $response;
  }

  protected function sendPostRequest($url, $body = array(), $headers = null) {
    $client = new Guzzle\Service\Client();

    $header = $this->getHeaders();
    if ($headers) {
      $header = $headers;
    }

    $request = $client->post($url, $header, $body);
    $response = $request->send();

    return $response;
  }

  protected function sendPutRequest($url, $body = array()) {
    $client = new Guzzle\Service\Client();

    $request = $client->put($url, $this->getHeaders(), $body);
    $response = $request->send();

    return $response;
  }

  protected function sendDeleteRequest($url, $body = array()) {
    $client = new Guzzle\Service\Client();

    $request = $client->put($url, $this->getHeaders(), $body);
    $response = $request->send();

    return $response;
  }

  private function getHeaders() {
    return array(
      'X-FTVEN-ID' => $this->accessToken,
      'Content-Type' => 'application/json',
    );
  }

}
