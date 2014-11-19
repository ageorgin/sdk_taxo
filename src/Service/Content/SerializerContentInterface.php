<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 17:11
 */

namespace Ftven\SdkTaxonomy\Service\Content;

use Ftven\SdkTaxonomy\Entity\Content;

interface SerializerContentInterface
{
    public function serialize(Content $content);

    public function serializeSearch(array $tags, $synonyms = false, $children = false, $page = 1, $limit = 100);
} 