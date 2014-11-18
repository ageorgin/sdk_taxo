<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 17:30
 */

class MapperContent implements MapperContentInterface
{
    public function populateContent(Content $content, $data)
    {
        $content->setId($data['id']);
        $content->setUri($data['uri']);
        $content->setType($data['type']);
        $content->setProduct($data['product']);
        $content->setTags($data['tags']);
        $content->setAuthor($data['author']);

        // todo champs date et active
    }
}