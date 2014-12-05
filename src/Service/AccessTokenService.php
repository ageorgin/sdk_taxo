<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 17/11/14
 * Time: 11:48
 */

namespace Ftven\SdkTaxonomy\Service;

use Ftven\SdkTaxonomy\Entity\AccessToken;
use Ftven\SdkTaxonomy\Service\AccessToken\GenerateAccessTokenInterface;

class AccessTokenService implements AccessTokenServiceInterface
{
    /**
     * @var AccessToken
     */
    private $accessToken = null;

    /**
     * @var GenerateAccessTokenInterface
     */
    private $generateService = null;

    public function checkAccessToken()
    {
        $now = new \DateTime();

        // le token n'existe pas ou a expiré
        if (null === $this->getAccessToken()->getToken() ||  $this->getAccessToken()->getExpire()->getTimestamp() < $now->getTimestamp()) {
            $this->generateAccessToken();
        }
    }

    public function getHeaders()
    {
        $this->checkAccessToken();
        return ['X-FTVEN-ID' => 'id: ' . $this->getAccessToken()->getId() . ', expire: ' . $this->getAccessToken()->getExpire()->format('Y-m-d\TH:i:sO') . ', token: ' . $this->getAccessToken()->getToken()];
    }

    protected function generateAccessToken()
    {
        $this->accessToken = $this->getGenerateService()->execute($this->getAccessToken());
    }

    /**
     * @param GenerateAccessTokenInterface $generateService
     */
    public function setGenerateService($generateService)
    {
        $this->generateService = $generateService;
    }

    /**
     * @return GenerateAccessTokenInterface
     */
    public function getGenerateService()
    {
        return $this->generateService;
    }

    /**
     * @param AccessToken $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return AccessToken
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
