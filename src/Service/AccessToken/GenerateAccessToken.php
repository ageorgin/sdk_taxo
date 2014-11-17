<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 17/11/14
 * Time: 12:04
 */

class GenerateAccessToken implements GenerateAccessTokenInterface
{
    const URI = '/access_token';

    /**
     * @var GuzzleServiceInterface
     */
    private $guzzleService = null;

    public function execute(AccessToken $accessToken)
    {
        $response = $this->getGuzzleService()->post(self::URI, null, ['X-FTVEN-ID' => "id: " . $accessToken->getId()]);

        $headerAT = $response->getHeader('X-FTVEN-ID');

    }

    /**
     * @param \GuzzleServiceInterface $guzzleService
     */
    public function setGuzzleService($guzzleService)
    {
        $this->guzzleService = $guzzleService;
    }

    /**
     * @return \GuzzleServiceInterface
     */
    public function getGuzzleService()
    {
        if (null == $this->guzzleService) {
            $this->guzzleService = new GuzzleService();
        }
        return $this->guzzleService;
    }
} 