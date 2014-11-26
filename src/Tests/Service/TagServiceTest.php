<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 24/11/14
 * Time: 09:24
 */

class TagServiceTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    /**
     * @dataProvider autocompleteDataProvider
     */
    public function testAutocomplete($filter, $sort)
    {
        $mockAutocompleteSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\Tag\AutocompleteTag', array('execute'));
        $mockAutocompleteSvc
            ->expects($this->once())
            ->method('execute')
            ->with($filter, $sort)
            ->willReturn('autocompleteSvc');

        $svc = new \Ftven\SdkTaxonomy\Service\TagService();
        $svc->setAutocompleteSvc($mockAutocompleteSvc);
        $this->assertEquals('autocompleteSvc', $svc->autocomplete($filter, $sort));
    }

    public function autocompleteDataProvider()
    {
        return [
            [null, null],
            ['filter', null],
            [null, 'sort'],
            ['filter', 'sort']
        ];
    }

    public function testCreateTag()
    {
        $mockCreateTag = $this->getMock('\Ftven\SdkTaxonomy\Service\Tag\CreateTag', array('execute'));
        $mockCreateTag
            ->expects($this->once())
            ->method('execute')
            ->willReturn('executeCreateTag');

        $svc = new \Ftven\SdkTaxonomy\Service\TagService();
        $svc->setCreateSvc($mockCreateTag);
        $this->assertEquals('executeCreateTag', $svc->createTag(new \Ftven\SdkTaxonomy\Entity\Tag()));
    }

    public function testGetTag()
    {
        $mockReadTag = $this->getMock('\Ftven\SdkTaxonomy\Service\Tag\ReadTag', array('execute'));
        $mockReadTag
            ->expects($this->once())
            ->method('execute')
            ->willReturn('executeReadTag');

        $svc = new \Ftven\SdkTaxonomy\Service\TagService();
        $svc->setReadSvc($mockReadTag);
        $this->assertEquals('executeReadTag', $svc->getTag(666));
    }
} 