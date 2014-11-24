<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 21/11/14
 * Time: 14:45
 */

class MapperContentTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    public function testPopulateContent()
    {
        $content = new \Ftven\SdkTaxonomy\Entity\Content();
        $svc = new \Ftven\SdkTaxonomy\Service\Content\MapperContent();
        $svc->populateContent($content, [
            'id' => 'mon-id',
            'uri' => 'mon-uri',
            'type' => 'mon-type',
            'product' => 'mon-product',
            'tags' => 'mon-tag',
            'author' => 'mon-author'
        ]);

        $this->assertEquals('mon-id', $content->getId());
        $this->assertEquals('mon-uri', $content->getUri());
        $this->assertEquals('mon-type', $content->getType());
        $this->assertEquals('mon-product', $content->getProduct());
        $this->assertEquals('mon-tag', $content->getTags());
        $this->assertEquals('mon-author', $content->getAuthor());
    }

    public function testGetContents()
    {
        $svc = new \Ftven\SdkTaxonomy\Service\Content\MapperContent();
        $result = $svc->getContents(
            [
                [
                    'id' => 'mon-id',
                    'uri' => 'mon-uri',
                    'type' => 'mon-type',
                    'product' => 'mon-product',
                    'tags' => 'mon-tag',
                    'author' => 'mon-author'
                ],
                [
                    'id' => 'mon-id2',
                    'uri' => 'mon-uri2',
                    'type' => 'mon-type2',
                    'product' => 'mon-product2',
                    'tags' => 'mon-tag2',
                    'author' => 'mon-author2'
                ]
            ]
        );

        $content1 = new \Ftven\SdkTaxonomy\Entity\Content();
        $content1->setId('mon-id');
        $content1->setUri('mon-uri');
        $content1->setType('mon-type');
        $content1->setProduct('mon-product');
        $content1->setTags('mon-tag');
        $content1->setAuthor('mon-author');

        $content2 = new \Ftven\SdkTaxonomy\Entity\Content();
        $content2->setId('mon-id2');
        $content2->setUri('mon-uri2');
        $content2->setType('mon-type2');
        $content2->setProduct('mon-product2');
        $content2->setTags('mon-tag2');
        $content2->setAuthor('mon-author2');

        $expected = [$content1, $content2];
        $this->assertEquals(2, count($result));
        $this->assertEquals($expected, $result);
    }
} 