<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 21/11/14
 * Time: 15:55
 */

class MapperTagTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    public function testPopulateTag()
    {
        $tag = new \Ftven\SdkTaxonomy\Entity\Tag();
        $svc = new \Ftven\SdkTaxonomy\Service\Tag\MapperTag();
        $svc->populateTag($tag, [
            'id' => 'mon-id',
            'author' => 'mon-author',
            'comment' => 'mon-comment',
            'label' => 'mon-label',
            'parent_tags' => 'mes-parent-tags',
            'preferred_tag' => 'mon-preferred-tag',
            'product' => 'mon-product',
            'status' => 'mon-status',
            'type' => 'mon-type'
        ]);

        $this->assertEquals('mon-id', $tag->getId());
        $this->assertEquals('mon-author', $tag->getAuthor());
        $this->assertEquals('mon-comment', $tag->getComment());
        $this->assertEquals('mon-label', $tag->getLabel());
        $this->assertEquals('mes-parent-tags', $tag->getParents());
        $this->assertEquals('mon-preferred-tag', $tag->getPreferredTag());
        $this->assertEquals('mon-product', $tag->getProduct());
        $this->assertEquals('mon-status', $tag->getStatus());
        $this->assertEquals('mon-type', $tag->getType());
    }

    public function testGetTags()
    {
        $svc = new \Ftven\SdkTaxonomy\Service\Tag\MapperTag();
        $result = $svc->getTags(
            [
                [
                    'id' => 'mon-id',
                    'author' => 'mon-author',
                    'comment' => 'mon-comment',
                    'label' => 'mon-label',
                    'parent_tags' => 'mes-parent-tags',
                    'preferred_tag' => 'mon-preferred-tag',
                    'product' => 'mon-product',
                    'status' => 'mon-status',
                    'type' => 'mon-type'
                ],
                [
                    'id' => 'mon-id2',
                    'author' => 'mon-author2',
                    'comment' => 'mon-comment2',
                    'label' => 'mon-label2',
                    'parent_tags' => 'mes-parent-tags2',
                    'preferred_tag' => 'mon-preferred-tag2',
                    'product' => 'mon-product2',
                    'status' => 'mon-status2',
                    'type' => 'mon-type2'
                ]
            ]
        );

        $tag1 = new \Ftven\SdkTaxonomy\Entity\Tag();
        $tag1->setId('mon-id');
        $tag1->setAuthor('mon-author');
        $tag1->setComment('mon-comment');
        $tag1->setLabel('mon-label');
        $tag1->setParents('mes-parent-tags');
        $tag1->setPreferredTag('mon-preferred-tag');
        $tag1->setProduct('mon-product');
        $tag1->setStatus('mon-status');
        $tag1->setType('mon-type');

        $tag2 = new \Ftven\SdkTaxonomy\Entity\Tag();
        $tag2->setId('mon-id2');
        $tag2->setAuthor('mon-author2');
        $tag2->setComment('mon-comment2');
        $tag2->setLabel('mon-label2');
        $tag2->setParents('mes-parent-tags2');
        $tag2->setPreferredTag('mon-preferred-tag2');
        $tag2->setProduct('mon-product2');
        $tag2->setStatus('mon-status2');
        $tag2->setType('mon-type2');

        $expected = [$tag1, $tag2];

        $this->assertEquals(2, count($result));
        $this->assertEquals($expected, $result);
    }
}
