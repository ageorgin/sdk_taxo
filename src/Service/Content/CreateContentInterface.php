<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 17:14
 */

namespace Ftven\SdkTaxonomy\Service\Content;

use Ftven\SdkTaxonomy\Entity\Content;

interface CreateContentInterface
{
    public function execute(Content $content);
}
