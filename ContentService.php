<?php

require_once 'Service.php';
require_once 'Content.php';

class ContentService extends Service
{

  public function getContent($id) {
    // TODO GET /contents/$id
  }

  public function getContentByTags($tags, $synonyms = false, $children = false, $page = 1, $limit = 100) {
    $ch = curl_init();

    $params = array(
      'tags' => implode($tags, ','),
      'synonyms' => $synonyms,
      'children' => $children,
      'page' => $page,
      'limit' => $limit
    );
    curl_setopt($ch, CURLOPT_URL, $this->urlAPI . "/contents/" . parent::addParamUrl($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "X-FTVEN-ID: " . $this->accessToken));
    $response = curl_exec($ch);
    curl_close($ch);

    // TODO gestion des retours http

    $json = json_decode($response);
    $contents = array();
    foreach ($json as $content) {
      $tmp = new Content($content->id);
      $tmp->setAuthor($content->author);
      $tmp->setUri($content->uri);
      $tmp->setType($content->type);
      $tmp->setProduct($content->product);
      $tmp->setTags($content->tags);
      $tmp->setFromSynonym($synonyms);
      $tmp->setFromChild($children);
      $contents[] = $tmp;
    }
    return $contents;
  }

  public function createContent(&$content) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->urlAPI . "/contents");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content->contentToArray()));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "X-FTVEN-ID: " . $this->accessToken));
    $response = curl_exec($ch);
    $headers = Service::get_headers_from_curl_response($response);
    $json = json_decode($response);
    curl_close($ch);

    $error_message = 'Impossible de créer un contenu dans le thésaurus taxonomie';
    if (empty($headers)) {
      throw new Exception($error_message . ' : l\'API ne réponds pas');
    }
    elseif (strpos($headers['http_code'], '201') === FALSE && empty($json)) {
      throw new Exception($error_message . ' : ' . $headers['http_code']);
    }
    elseif (isset($json->error)) {
      throw new Exception($error_message .= ' : ' . implode(', ', $json->error->messages));
    }

    if (isset($json->id)) {
      $content->setId($json->id);
    }
  }

  public function updateContent(&$content) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->urlAPI . "/contents/" . $content->getId());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content->contentToArray()));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "X-FTVEN-ID: " . $this->accessToken));
    $response = curl_exec($ch);
    $headers = Service::get_headers_from_curl_response($response);
    $json = json_decode($response);
    curl_close($ch);

    $error_message = 'Impossible de mettre à jour un contenu dans le thésaurus taxonomie';
    if (empty($headers)) {
      throw new Exception($error_message . ' : l\'API ne réponds pas');
    }
    elseif (strpos($headers['http_code'], '200') === FALSE && empty($json)) {
      throw new Exception($error_message . ' : ' . $headers['http_code']);
    }
    elseif (isset($json->error)) {
      throw new Exception($error_message .= ' : ' . implode(', ', $json->error->messages));
    }
  }

  public function deleteContent(&$content) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->urlAPI . "/contents/" . $content->getId());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "X-FTVEN-ID: " . $this->accessToken));
    $response = curl_exec($ch);
    $headers = Service::get_headers_from_curl_response($response);
    $json = json_decode($response);
    curl_close($ch);

    $error_message = 'Impossible de supprimer un contenu dans le thésaurus taxonomie';
    if (empty($headers)) {
      throw new Exception($error_message . ' : l\'API ne réponds pas');
    }
    elseif (strpos($headers['http_code'], '204') === FALSE && empty($json)) {
      throw new Exception($error_message . ' : ' . $headers['http_code']);
    }
    elseif (isset($json->error)) {
      throw new Exception($error_message .= ' : ' . implode(', ', $json->error->messages));
    }
  }

  public function loadPage($content) {
    try {
      $response = @file_get_contents($content->getUri());
    } catch (Exception $e) {
      throw new Exception('Impossible de lire le contenu : ' . $e->getMessage());
    }
    return json_decode($response);
  }
}
