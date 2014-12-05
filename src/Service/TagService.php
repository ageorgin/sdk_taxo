<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 10:00
 */

namespace Ftven\SdkTaxonomy\Service;

use Ftven\SdkTaxonomy\Entity\Tag;
use Ftven\SdkTaxonomy\Service\Tag\AutocompleteTagInterface;
use Ftven\SdkTaxonomy\Service\Tag\CreateTagInterface;
use Ftven\SdkTaxonomy\Service\Tag\ReadTagInterface;

class TagService implements TagServiceInterface
{
    /**
     * @var AutocompleteTagInterface
     */
    private $autocompleteSvc = null;

    /**
     * @var CreateTagInterface
     */
    private $createSvc = null;

    /**
     * @var ReadTagInterface
     */
    private $readSvc = null;

    /**
     * @param null $string
     * @param null $sort
     * @return mixed
     */
    public function autocomplete($string = null, $sort = null)
    {
        return $this->getAutocompleteSvc()->execute($string, $sort);
    }

    /**
     * @param Tag $tag
     * @return mixed
     */
    public function createTag(Tag $tag)
    {
        return $this->getCreateSvc()->execute($tag);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTag($id)
    {
        return $this->getReadSvc()->execute($id);
    }

    /**
     * @param AutocompleteTagInterface $autocompleteSvc
     */
    public function setAutocompleteSvc($autocompleteSvc)
    {
        $this->autocompleteSvc = $autocompleteSvc;
    }

    /**
     * @return AutocompleteTagInterface
     */
    public function getAutocompleteSvc()
    {
        return $this->autocompleteSvc;
    }

    /**
     * @param CreateTagInterface $createSvc
     */
    public function setCreateSvc($createSvc)
    {
        $this->createSvc = $createSvc;
    }

    /**
     * @return CreateTagInterface
     */
    public function getCreateSvc()
    {
        return $this->createSvc;
    }

    /**
     * @param \Ftven\SdkTaxonomy\Service\Tag\ReadTagInterface $readSvc
     */
    public function setReadSvc($readSvc)
    {
        $this->readSvc = $readSvc;
    }

    /**
     * @return \Ftven\SdkTaxonomy\Service\Tag\ReadTagInterface
     */
    public function getReadSvc()
    {
        return $this->readSvc;
    }
}
