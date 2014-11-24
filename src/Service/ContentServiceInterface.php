<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 17/11/14
 * Time: 11:09
 */

namespace Ftven\SdkTaxonomy\Service;

use Ftven\SdkTaxonomy\Entity\Content;

interface ContentServiceInterface
{
    public function getContentByTags($tags, $synonyms = false, $children = false, $page = 1, $limit = 100);

    public function createContent(Content $content);

    public function updateContent(Content $content);

    public function deleteContent(Content $content);
} 