<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 26/11/14
 * Time: 11:44
 */

namespace Ftven\SdkTaxonomy\Service\Tag;


use Ftven\SdkTaxonomy\Service\AbstractApiService;

class AbstractTag extends AbstractApiService
{
    const URI = '/tags';

    /**
     * @var SerializerTagInterface
     */
    private $serializerSvc;

    /**
     * @var MapperTagInterface
     */
    private $mapperSvc;

    /**
     * @param \Ftven\SdkTaxonomy\Service\Tag\MapperTagInterface $mapperSvc
     */
    public function setMapperSvc($mapperSvc)
    {
        $this->mapperSvc = $mapperSvc;
    }

    /**
     * @return \Ftven\SdkTaxonomy\Service\Tag\MapperTagInterface
     */
    public function getMapperSvc()
    {
        return $this->mapperSvc;
    }

    /**
     * @param \Ftven\SdkTaxonomy\Service\Tag\SerializerTagInterface $serializerSvc
     */
    public function setSerializerSvc($serializerSvc)
    {
        $this->serializerSvc = $serializerSvc;
    }

    /**
     * @return \Ftven\SdkTaxonomy\Service\Tag\SerializerTagInterface
     */
    public function getSerializerSvc()
    {
        return $this->serializerSvc;
    }


} 