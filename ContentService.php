<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
*/

require_once 'Service.php';
require_once 'Content.php';

class ContentService extends Service
{

  public function getContent($id) {
    // TODO GET /contents/{id}
  }

  public function getContentByTags($tags, $synonyms = false, $children = false, $page = 1, $limit = 100) {
    // TODO GET /contents/?tags={tags}&synonyms={synonyms}&children={children}&page={page}&limit={limit}
  }

  public function createContent(&$content) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->urlAPI . "/contents");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content->contentToArray()));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "X-FTVEN-ID: " . $this->accessToken));
    $response = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($response);
    dpm($json, '$json create');

    if (empty($json)) {
      throw new Exception('Impossible de créer un content');
    }

    $content->setId($json->id);
  }

  public function updateContent(&$content) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->urlAPI . "/contents/" . $content->id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_PUT, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content->contentToArray()));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "X-FTVEN-ID: " . $this->accessToken));
    $response = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($response);
    dpm($json, '$json update');

    if (empty($json)) {
      throw new Exception('Impossible de mettre à jour un content');
    }
  }

  public function deleteContent(&$content) {
    // TODO DELETE /contents
  }
}
