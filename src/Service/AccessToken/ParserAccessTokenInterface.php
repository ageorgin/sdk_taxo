<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 17/11/14
 * Time: 17:33
 */

namespace Ftven\SdkTaxonomy\Service\AccessToken;

interface ParserAccessTokenInterface
{
    public function parseXFtvenId($xFtvenId);
}
