<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 17:07
 */

namespace Ftven\SdkTaxonomy\Service;

use Ftven\SdkTaxonomy\Entity\Content;
use Ftven\SdkTaxonomy\Service\Content\CreateContentInterface;
use Ftven\SdkTaxonomy\Service\Content\DeleteContentInterface;
use Ftven\SdkTaxonomy\Service\Content\UpdateContentInterface;

class ContentService implements ContentServiceInterface
{
    /**
     * @var CreateContentInterface
     */
    private $createSvc;

    /**
     * @var UpdateContentInterface
     */
    private $updateSvc;

    /**
     * @var DeleteContentInterface
     */
    private $deleteSvc;

    /**
     * @var \SearchContentInterface
     */
    private $searchSvc;

    public function getContentByTags($tags, $synonyms = false, $children = false, $page = 1, $limit = 100)
    {
        return $this->getSearchSvc()->execute($tags, $synonyms, $children, $page, $limit);
    }

    public function createContent(Content $content)
    {
        return $this->getCreateSvc()->execute($content);
    }

    public function updateContent(Content $content)
    {
        return $this->getUpdateSvc()->execute($content);
    }

    public function deleteContent(Content $content)
    {
        return $this->getDeleteSvc()->execute($content);
    }

    /**
     * @param CreateContentInterface $createSvc
     */
    public function setCreateSvc($createSvc)
    {
        $this->createSvc = $createSvc;
    }

    /**
     * @return CreateContentInterface
     */
    public function getCreateSvc()
    {
        return $this->createSvc;
    }

    /**
     * @param UpdateContentInterface $updateSvc
     */
    public function setUpdateSvc($updateSvc)
    {
        $this->updateSvc = $updateSvc;
    }

    /**
     * @return UpdateContentInterface
     */
    public function getUpdateSvc()
    {
        return $this->updateSvc;
    }

    /**
     * @param DeleteContentInterface $deleteSvc
     */
    public function setDeleteSvc($deleteSvc)
    {
        $this->deleteSvc = $deleteSvc;
    }

    /**
     * @return DeleteContentInterface
     */
    public function getDeleteSvc()
    {
        return $this->deleteSvc;
    }

    /**
     * @param SearchContentInterface $searchSvc
     */
    public function setSearchSvc($searchSvc)
    {
        $this->searchSvc = $searchSvc;
    }

    /**
     * @return SearchContentInterface
     */
    public function getSearchSvc()
    {
        return $this->searchSvc;
    }
} 