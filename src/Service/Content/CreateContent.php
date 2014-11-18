<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 17:15
 */

class CreateContent extends AbstractApiService implements CreateContentInterface
{
    const URI = '/contents';

    /**
     * @var SerializerContentInterface
     */
    private $serialiserSvc;

    /**
     * @var MapperContentInterface
     */
    private $mapperSvc;

    public function execute(Content $content)
    {
        $response = $this->getGuzzleSvc()->post(
            self::URI,
            $this->getSerialiserSvc()->serialize($content),
            array_merge(
                ['Content-Type' => 'application/json'],
                $this->getAccessTokenSvc()->getHeaders()
            )
        );

        $response = $response->json();
        $this->getMapperSvc()->populateContent($content, $response);
    }

    /**
     * @param \SerializerContentInterface $serialiserSvc
     */
    public function setSerialiserSvc($serialiserSvc)
    {
        $this->serialiserSvc = $serialiserSvc;
    }

    /**
     * @return \SerializerContentInterface
     */
    public function getSerialiserSvc()
    {
        if (null === $this->serialiserSvc) {
            $this->serialiserSvc = new SerializerContent();
        }
        return $this->serialiserSvc;
    }

    /**
     * @param \MapperContentInterface $mapperSvc
     */
    public function setMapperSvc($mapperSvc)
    {
        $this->mapperSvc = $mapperSvc;
    }

    /**
     * @return \MapperContentInterface
     */
    public function getMapperSvc()
    {
        if (null === $this->mapperSvc) {
            $this->mapperSvc = new MapperContent();
        }
        return $this->mapperSvc;
    }
} 