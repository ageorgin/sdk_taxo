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
    // TODO POST /contents
  }

  public function updateContent(&$content) {
    // TODO PUT /contents
  }

  public function deleteContent(&$content) {
    // TODO DELETE /contents
  }
}
