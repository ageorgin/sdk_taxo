<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 15:54
 */

class CreateTag implements CreateTagInterface
{
    const URI = '/tags';

    /**
     * @var GuzzleServiceInterface
     */
    private $guzzleSvc = null;

    /**
     * @var SerializerTagInterface
     */
    private $serializerSvc = null;

    /**
     * @var AccessTokenService
     */
    private $accessTokenSvc = null;

    /**
     * @var MapperTagInterface
     */
    private $mapperSvc = null;

    public function execute(Tag $tag)
    {
        $response = $this->getGuzzleSvc()->post(
            self::URI,
            $this->getSerializerSvc()->getCreateSerialization($tag),
            array_merge(
                ['Content-Type' => 'application/json'],
                $this->getAccessTokenSvc()->getHeaders()
            )
        );

        $response = $response->json();
        $this->getMapperSvc()->populateTag($tag, $response);
    }

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
     * @param \SerializerTagInterface $serializerSvc
     */
    public function setSerializerSvc($serializerSvc)
    {
        $this->serializerSvc = $serializerSvc;
    }

    /**
     * @return \SerializerTagInterface
     */
    public function getSerializerSvc()
    {
        if (null === $this->serializerSvc) {
            $this->serializerSvc = new SerializerTag();
        }
        return $this->serializerSvc;
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

    /**
     * @param \MapperTagInterface $mapperSvc
     */
    public function setMapperSvc($mapperSvc)
    {
        $this->mapperSvc = $mapperSvc;
    }

    /**
     * @return \MapperTagInterface
     */
    public function getMapperSvc()
    {
        if (null === $this->mapperSvc) {
            $this->mapperSvc = new MapperTag();
        }
        return $this->mapperSvc;
    }
} 