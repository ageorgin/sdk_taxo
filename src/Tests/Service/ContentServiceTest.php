<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 21/11/14
 * Time: 16:58
 */

class ContentServiceTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    public function testGetContentByTags()
    {
        $mock = $this->getMock('\Ftven\SdkTaxonomy\Service\Content\SearchContent', array('execute'));
        $mock
            ->expects($this->once())
            ->method('execute')
            ->with(['tag1', 'tag2'], false, false, 1, 100)
            ->willReturn('responseGetContentByTags');

        $svc = new \Ftven\SdkTaxonomy\Service\ContentService();
        $svc->setSearchSvc($mock);
        $this->assertEquals('responseGetContentByTags', $svc->getContentByTags(['tag1', 'tag2']));
    }

    public function testCreateContent()
    {
        $content = new \Ftven\SdkTaxonomy\Entity\Content();
        $mock = $this->getMock('\Ftven\SdkTaxonomy\Service\Content\CreateContent', array('execute'));
        $mock
            ->expects($this->once())
            ->method('execute')
            ->with($content)
            ->willReturn('responseCreateContent');

        $svc = new \Ftven\SdkTaxonomy\Service\ContentService();
        $svc->setCreateSvc($mock);
        $this->assertEquals('responseCreateContent', $svc->createContent($content));
    }

    public function testUpdateContent()
    {
        $content = new \Ftven\SdkTaxonomy\Entity\Content();
        $mock = $this->getMock('\Ftven\SdkTaxonomy\Service\Content\UpdateContent', array('execute'));
        $mock
            ->expects($this->once())
            ->method('execute')
            ->with($content)
            ->willReturn('responseUpdateContent');

        $svc = new \Ftven\SdkTaxonomy\Service\ContentService();
        $svc->setUpdateSvc($mock);
        $this->assertEquals('responseUpdateContent', $svc->updateContent($content));
    }

    public function testDeleteContent()
    {
        $content = new \Ftven\SdkTaxonomy\Entity\Content();
        $mock = $this->getMock('\Ftven\SdkTaxonomy\Service\Content\DeleteContent', array('execute'));
        $mock
            ->expects($this->once())
            ->method('execute')
            ->with($content)
            ->willReturn('responseDeleteContent');

        $svc = new \Ftven\SdkTaxonomy\Service\ContentService();
        $svc->setDeleteSvc($mock);
        $this->assertEquals('responseDeleteContent', $svc->deleteContent($content));
    }
} 