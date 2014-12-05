<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 10:08
 */

namespace Ftven\SdkTaxonomy\Service\Tag;

interface AutocompleteTagInterface
{
    public function execute($filter, $sort = null);
}
