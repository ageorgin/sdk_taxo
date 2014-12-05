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
            'author' => 'mon-author',
            'active' => true,
            'date' => '2014-12-05T16:59:49+0100'
        ]);

        $this->assertEquals('mon-id', $content->getId());
        $this->assertEquals('mon-uri', $content->getUri());
        $this->assertEquals('mon-type', $content->getType());
        $this->assertEquals('mon-product', $content->getProduct());
        $this->assertEquals('mon-tag', $content->getTags());
        $this->assertEquals('mon-author', $content->getAuthor());
        $this->assertTrue($content->getActive());
        $this->assertInstanceOf('\DateTime', $content->getDate());
        $this->assertEquals('05/12/2014 16:59:49', $content->getDate()->format('d/m/Y H:i:s'));
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
                    'author' => 'mon-author',
                    'active' => false,
                    'date' => '2014-12-31T23:59:59+0100'
                ],
                [
                    'id' => 'mon-id2',
                    'uri' => 'mon-uri2',
                    'type' => 'mon-type2',
                    'product' => 'mon-product2',
                    'tags' => 'mon-tag2',
                    'author' => 'mon-author2',
                    'active' => true,
                    'date' => '2014-08-21T05:00:00+0100'
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
        $content1->setActive(false);
        $content1->setDate(new \DateTime('2014-12-31T23:59:59+0100'));

        $content2 = new \Ftven\SdkTaxonomy\Entity\Content();
        $content2->setId('mon-id2');
        $content2->setUri('mon-uri2');
        $content2->setType('mon-type2');
        $content2->setProduct('mon-product2');
        $content2->setTags('mon-tag2');
        $content2->setAuthor('mon-author2');
        $content2->setActive(true);
        $content2->setDate(new \DateTime('2014-08-21T05:00:00+0100'));

        $expected = [$content1, $content2];
        $this->assertEquals(2, count($result));
        $this->assertEquals($expected, $result);
    }
}
