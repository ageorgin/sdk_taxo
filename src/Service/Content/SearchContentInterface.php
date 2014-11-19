<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 19/11/14
 * Time: 11:43
 */

namespace Ftven\SdkTaxonomy\Service\Content;

interface SearchContentInterface
{
    public function execute(array $tags, $synonyms = false, $children = false, $page = 1, $limit = 100);
} 