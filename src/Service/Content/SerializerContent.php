<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 17:11
 */

namespace Ftven\SdkTaxonomy\Service\Content;

use Ftven\SdkTaxonomy\Entity\Content;

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

    public function serializeSearch(array $tags, $synonyms = false, $children = false, $page = 1, $limit = 100)
    {
        return [
            'tags' => implode($tags, ','),
            'synonyms' => $synonyms,
            'children' => $children,
            'page' => $page,
            'limit' => $limit
        ];
    }


} 