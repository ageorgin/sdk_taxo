<?php

require_once 'Service.php';
require_once 'Content.php';

class ContentService extends Service {

  public function getContent($id) {
    // TODO GET /contents/$id
  }

  public function getContentByTags($tags, $synonyms = false, $children = false, $page = 1, $limit = 100) {
    $params = array(
      'tags' => implode($tags, ','),
      'synonyms' => $synonyms,
      'children' => $children,
      'page' => $page,
      'limit' => $limit
    );

    $response = parent::sendGetRequest($this->urlAPI . "/contents/", $params);

    $contents = array();
    foreach ($response->json() as $content) {
      $tmp = new Content($content['id']);
      $tmp->setAuthor($content['author']);
      $tmp->setUri($content['uri']);
      $tmp->setType($content['type']);
      $tmp->setProduct($content['product']);
      $tmp->setTags($content['tags']);
      $tmp->setFromSynonym($synonyms);
      $tmp->setFromChild($children);
      $contents[] = $tmp;
    }
    return $contents;
  }

  public function createContent(&$content) {
    $response = parent::sendPostRequest($this->urlAPI . "/contents", $content->contentToArray());
    $responseBody = $response->json();

    if (isset($responseBody['id'])) {
      $content->setId($responseBody['id']);
    }
  }

  public function updateContent(&$content) {
    parent::sendPutRequest($this->urlAPI . "/contents/" . $content->getId(), $content->contentToArray());
  }

  public function deleteContent(&$content) {
    parent::sendDeleteRequest($this->urlAPI . "/contents/" . $content->getId());
  }

  public function loadPage($content) {
    try {
      $response = @file_get_contents($content->getUri());
    }
    catch (Exception $e) {
      throw new Exception('Impossible de lire le contenu : ' . $e->getMessage());
    }
    return json_decode($response);
  }

}
