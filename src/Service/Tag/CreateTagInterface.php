<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 15:54
 */

namespace Ftven\SdkTaxonomy\Service\Tag;

use Ftven\SdkTaxonomy\Entity\Tag;

interface CreateTagInterface
{
    public function execute(Tag $tag);
}
