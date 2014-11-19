<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 19/11/14
 * Time: 09:40
 */

abstract class AbstractContent extends AbstractApiService
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