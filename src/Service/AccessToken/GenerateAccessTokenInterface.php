<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 17/11/14
 * Time: 12:03
 */

namespace Ftven\SdkTaxonomy\Service\AccessToken;

use Ftven\SdkTaxonomy\Entity\AccessToken;

interface GenerateAccessTokenInterface
{
    public function execute(AccessToken $accessToken);
} 