<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 17/11/14
 * Time: 11:48
 */

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
        $accessTokenValid = true;

        if (null === $this->accessToken) {
            $this->accessToken = new AccessToken();
            //todo ligne suivante à supprimer
            $this->accessToken->setId('info');
            $accessTokenValid = false;
        }

        if (!$accessTokenValid) {
            $this->generateAccessToken();
        }
    }

    public function getHeaders()
    {
        // TODO: Implement getHeaders() method.
    }

    protected function generateAccessToken()
    {
        $this->accessToken = $this->getGenerateService()->execute($this->accessToken);
    }

    /**
     * @param \GenerateAccessTokenInterface $generateService
     */
    public function setGenerateService($generateService)
    {
        $this->generateService = $generateService;
    }

    /**
     * @return \GenerateAccessTokenInterface
     */
    public function getGenerateService()
    {
        if (null == $this->generateService) {
            $this->generateService = new GenerateAccessToken();
        }
        return $this->generateService;
    }
} 