<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 10:12
 */

class AutocompleteTag implements AutocompleteTagInterface
{
    const URI = '/tags/autocomplete/';

    /**
     * @var GuzzleServiceInterface
     */
    private $guzzleSvc = null;

    /**
     * @var AccessTokenServiceInterface
     */
    private $accessTokenSvc = null;

    /**
     * @var MapperTagInterface
     */
    private $mapperSvc = null;

    public function execute($filter, $page, $limit, $sort = null)
    {
        $params = [
            'page' => $page,
            'limit' => $limit
        ];
        if (null !== $sort) {
            $params['sort'] = $sort;
        }

        $response = $this->getGuzzleSvc()->get(self::URI . $filter, $this->getAccessTokenSvc()->getHeaders(), $params);
        return $this->getMapperSvc()->getTags($response);
    }

    /**
     * @param \AccessTokenServiceInterface $accessTokenSvc
     */
    public function setAccessTokenSvc($accessTokenSvc)
    {
        $this->accessTokenSvc = $accessTokenSvc;
    }

    /**
     * @return \AccessTokenServiceInterface
     */
    public function getAccessTokenSvc()
    {
        if (null === $this->accessTokenSvc) {
            $this->accessTokenSvc = new AccessToken();
        }

        return $this->accessTokenSvc;
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