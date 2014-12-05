<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 11:04
 */

namespace Ftven\SdkTaxonomy\Service\Tag;

use Ftven\SdkTaxonomy\Entity\Tag;

interface MapperTagInterface
{
    public function getTags($data);

    public function populateTag(Tag $tag, $data);
}
