<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 17:07
 */

class ContentService implements ContentServiceInterface
{
    /**
     * @var CreateContentInterface
     */
    private $createSvc;

    public function getContentByTags($tags, $synonyms = false, $children = false, $page = 1, $limit = 100)
    {
        // TODO: Implement getContentByTags() method.
    }

    public function createContent(Content $content)
    {
        return $this->getCreateSvc()->execute($content);
    }

    public function updateContent(Content $content)
    {
        // TODO: Implement updateContent() method.
    }

    public function deleteContent(Content $content)
    {
        // TODO: Implement deleteContent() method.
    }

    public function loadPage(Content $content)
    {
        // TODO: Implement loadPage() method.
    }

    /**
     * @param \CreateContentInterface $createSvc
     */
    public function setCreateSvc($createSvc)
    {
        $this->createSvc = $createSvc;
    }

    /**
     * @return \CreateContentInterface
     */
    public function getCreateSvc()
    {
        if (null === $this->createSvc) {
            $this->createSvc = new CreateContent();
        }
        return $this->createSvc;
    }

} 