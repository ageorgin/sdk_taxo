<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 19/11/14
 * Time: 09:40
 */

namespace Ftven\SdkTaxonomy\Service\Content;

use Ftven\SdkTaxonomy\Service\AbstractApiService;

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
     * @param SerializerContentInterface $serialiserSvc
     */
    public function setSerialiserSvc($serialiserSvc)
    {
        $this->serialiserSvc = $serialiserSvc;
    }

    /**
     * @return SerializerContentInterface
     */
    public function getSerialiserSvc()
    {
        return $this->serialiserSvc;
    }

    /**
     * @param MapperContentInterface $mapperSvc
     */
    public function setMapperSvc($mapperSvc)
    {
        $this->mapperSvc = $mapperSvc;
    }

    /**
     * @return MapperContentInterface
     */
    public function getMapperSvc()
    {
        return $this->mapperSvc;
    }
} 