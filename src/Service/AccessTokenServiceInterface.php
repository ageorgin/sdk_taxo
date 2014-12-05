<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 17/11/14
 * Time: 11:13
 */

namespace Ftven\SdkTaxonomy\Service;

interface AccessTokenServiceInterface
{
    public function checkAccessToken();

    public function getHeaders();
}
