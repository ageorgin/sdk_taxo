<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Service.php';
require_once 'Tag.php';

class TagService extends Service {

  public function autocomplete($string = null, $sort = null, $page = 1, $limit = 1000) {
    $params = array(
      'sort' => $sort,
      'page' => $page,
      'limit' => $limit
    );

    $response = parent::sendGetRequest($this->urlAPI . "/tags/autocomplete/" . $string, $params);

    foreach ($response->json() as $rep) {
      $tmp = new Tag($rep['id']);
      $tmp->setAuthor($rep['author']);
      $tmp->setComment($rep['comment']);
      $tmp->setLabel($rep['label']);
      $tmp->setParents($rep['parent_tags']);
      $tmp->setPreferredTag($rep['preferred_tag']);
      $tmp->setProduct($rep['product']);
      $tmp->setStatus($rep['status']);
      $tmp->setType($rep['type']);
      $tags[] = $tmp;
    }

    return $tags;
  }

  public function createTag(&$tag) {

    $response = parent::sendPostRequest($this->urlAPI . "/tags", $tag->tagToArray());
    $responseBody = $response->json();

    $tag->setId($responseBody['id']);
  }

}
