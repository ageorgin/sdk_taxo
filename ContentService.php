<?php

require_once 'Service.php';
require_once 'Content.php';

class ContentService extends Service
{

  public function getContent($id) {
    $ch = curl_init();
    $url =$this->urlAPI . "/contents/" . $id;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "X-FTVEN-ID: " . $this->accessToken));
    $response = curl_exec($ch);
    $headers = Service::get_headers_from_curl_response($response);
    $json = json_decode($response);
    curl_close($ch);

    if (isset($json->id)) {
      return new Content($json->id);
    }
  }

  public function getContentByTags($tags, $synonyms = false, $children = false, $page = 1, $limit = 100) {
    // TODO GET /contents/?tags={tags}&synonyms={synonyms}&children={children}&page={page}&limit={limit}
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

    $error_message = 'Impossible de créer un content dans l\'API taxonomie';
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

    $error_message = 'Impossible de mettre à jour un content dans l\'API taxonomie';
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

    $error_message = 'Impossible de supprimer un content dans l\'API taxonomie';
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
}
