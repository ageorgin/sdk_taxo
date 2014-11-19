<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 17:23
 */

namespace Ftven\SdkTaxonomy\Service;

abstract class AbstractApiService
{
    /**
     * @var GuzzleServiceInterface
     */
    protected $guzzleSvc = null;

    /**
     * @var AccessTokenService
     */
    protected $accessTokenSvc = null;

    /**
     * @param GuzzleServiceInterface $guzzleSvc
     */
    public function setGuzzleSvc($guzzleSvc)
    {
        $this->guzzleSvc = $guzzleSvc;
    }

    /**
     * @return GuzzleServiceInterface
     */
    public function getGuzzleSvc()
    {
        return $this->guzzleSvc;
    }

    /**
     * @param AccessTokenService $accessTokenSvc
     */
    public function setAccessTokenSvc($accessTokenSvc)
    {
        $this->accessTokenSvc = $accessTokenSvc;
    }

    /**
     * @return AccessTokenService
     */
    public function getAccessTokenSvc()
    {
        return $this->accessTokenSvc;
    }
} 