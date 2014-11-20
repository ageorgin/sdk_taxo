<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 17/11/14
 * Time: 12:04
 */

namespace Ftven\SdkTaxonomy\Service\AccessToken;

use Ftven\SdkTaxonomy\Entity\AccessToken;
use Ftven\SdkTaxonomy\Exception\ApiException;
use Ftven\SdkTaxonomy\Service\GuzzleServiceInterface;

class GenerateAccessToken implements GenerateAccessTokenInterface
{
    const URI = '/access_token';

    /**
     * @var GuzzleServiceInterface
     */
    private $guzzleService = null;

    /**
     * @var ParserAccessTokenInterface
     */
    private $parserService = null;

    public function execute(AccessToken $accessToken)
    {
        $response = $this->getGuzzleService()->post(self::URI, null, ['X-FTVEN-ID' => "id: " . $accessToken->getId()]);

        if(!$response->hasHeader('X-FTVEN-ID')) {
            throw new ApiException('No header X-FTVEN-ID received');
        }

        $headerAT = $response->getHeader('X-FTVEN-ID')->toArray();
        $headerAT = $this->getParserService()->parseXFtvenId($headerAT[0]);

        $accessToken->setId($headerAT['id']);
        $accessToken->setExpire(new \DateTime($headerAT['expire']));
        $accessToken->setToken($headerAT['token']);

        return $accessToken;
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
        return $this->guzzleService;
    }

    /**
     * @param \ParserAccessTokenInterface $parserService
     */
    public function setParserService($parserService)
    {
        $this->parserService = $parserService;
    }

    /**
     * @return \ParserAccessTokenInterface
     */
    public function getParserService()
    {
        return $this->parserService;
    }
} 