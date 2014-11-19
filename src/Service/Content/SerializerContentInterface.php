<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 17:11
 */

interface SerializerContentInterface
{
    public function serialize(Content $content);

    public function serializeSearch(array $tags, $synonyms = false, $children = false, $page = 1, $limit = 100);
} 