<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
*/

require_once 'Service.php';
require_once 'Tag.php';

class TagService extends Service
{

  public function autocomplete($string = null, $sort = null, $page = null, $limit = null) {
    $ch = curl_init();

    $url = $this->urlAPI . "/tags/autocomplete/$string" . Service::addParamUrl($sort, $page, $limit);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-FTVEN-ID: " . $this->accessToken));
    $response = curl_exec($ch);
    curl_close($ch);
    $tags = array();

    foreach (json_decode($response) as $rep) {
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

  public function createTag(&$tag) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->urlAPI . "/tags");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n    \"label\": \"" . urlencode($tag->getLabel()) . "\",\n    \"author\": \"" . urlencode($tag->getAuthor()) . "\"\n}");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-FTVEN-ID: " . $this->accessToken));
    $response = curl_exec($ch);
    curl_close($ch);
    var_dump("X-FTVEN-ID: " . $this->accessToken);
    var_dump($this->urlAPI . "/tags");
    var_dump("{\n    \"label\": \"" . $tag->getLabel() . "\",\n    \"author\": \"" . $tag->getAuthor() . "\"\n}");
    var_dump($response);

    $json = json_decode($response);
    $tag->setId($json['id']);

    var_dump($json);
    die();
  }
}
