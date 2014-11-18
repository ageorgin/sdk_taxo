<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 17:11
 */

class SerializerContent implements SerializerContentInterface
{
    public function serialize(Content $content)
    {
        return [
            'uri' => $content->getUri(),
            'type' => $content->getType(),
            'tags' => $content->getTags(),
            'author' => $content->getAuthor(),
        ];
    }

} 