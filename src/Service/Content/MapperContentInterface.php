<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 17:29
 */

namespace Ftven\SdkTaxonomy\Service\Content;

use Ftven\SdkTaxonomy\Entity\Content;

interface MapperContentInterface
{
    public function populateContent(Content $content, $data);

    public function getContents($data);
}
