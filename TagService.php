<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Tag.php';

class TagService {

  protected $idClient = null;
  protected $urlAPI = null;
  protected $accessToken = null;
  protected $expires = null;

  public function __construct($idClient, $urlAPI) {
    /* $this->idClient = $idClient;
      $this->urlAPI = $urlAPI; */

    $this->idClient = '4586c1e60db11326d3b372c2ee41e48e';
    $this->urlAPI = 'http://private-anon-79abf6322-taxonomie.apiary-mock.com';
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
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->urlAPI . "/access_token");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-FTVEN-ID: id: " . $this->idClient));
    $response = curl_exec($ch);
    $this->accessToken = 'MTY0NDFhYWIwOWRhZTk0M2U1OWVkOGIzMWQwYTcyNTJhYTM4NmMyMzg2MmQxMjQ5Njc5ZTk0NGU5OTE2M2FlMg==';
    $this->expires = '2014-11-08T07:50:26-04:00';
    curl_close($ch);
  }

  public function autocomplete($string = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->urlAPI . "/tags/autocomplete/$string");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-FTVEN-ID: id: ".$this->idClient.", expire: ".$this->expires.", token: ".$this->accessToken));
    $response = curl_exec($ch);
    curl_close($ch);
    $tags = array();
    
    foreach(json_decode($response) as $rep){
      $tmp = new Tag($rep->id);
      $tmp->setAuthor($rep->author);
      $tmp->setComment($rep->comment);
      $tmp->setLabel($rep->label);
      $tmp->setParents($rep->parent_tags);
      $tmp->setPreferredTag($rep->preferred_tag);
      $tmp->setProduct($rep->product);
      $tmp->setStatus($rep->status);
      $tmp->setType($rep->type);
      $tags[] = $tmp;
    }

    return $tags;
  }

}
