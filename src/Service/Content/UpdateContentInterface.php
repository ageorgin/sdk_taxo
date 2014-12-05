<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 19/11/14
 * Time: 09:42
 */

namespace Ftven\SdkTaxonomy\Service\Content;

use Ftven\SdkTaxonomy\Entity\Content;

interface UpdateContentInterface
{
    public function execute(Content $content);
}
