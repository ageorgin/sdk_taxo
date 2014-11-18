<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 17:23
 */

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
     * @param \GuzzleServiceInterface $guzzleSvc
     */
    public function setGuzzleSvc($guzzleSvc)
    {
        $this->guzzleSvc = $guzzleSvc;
    }

    /**
     * @return \GuzzleServiceInterface
     */
    public function getGuzzleSvc()
    {
        if (null === $this->guzzleSvc) {
            $this->guzzleSvc = new GuzzleService();
        }
        return $this->guzzleSvc;
    }

    /**
     * @param \AccessTokenService $accessTokenSvc
     */
    public function setAccessTokenSvc($accessTokenSvc)
    {
        $this->accessTokenSvc = $accessTokenSvc;
    }

    /**
     * @return \AccessTokenService
     */
    public function getAccessTokenSvc()
    {
        if (null === $this->accessTokenSvc) {
            $this->accessTokenSvc = new AccessTokenService();
        }

        return $this->accessTokenSvc;
    }
} 