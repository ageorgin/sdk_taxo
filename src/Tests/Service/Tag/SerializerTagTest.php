<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 21/11/14
 * Time: 16:31
 */

class SerializerTagTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    /**
     * @dataProvider getCreateSerializationDataProvider
     */
    public function testGetCreateSerialization($tag, $expectedOutput)
    {
        $svc = new \Ftven\SdkTaxonomy\Service\Tag\SerializerTag();
        $this->assertEquals($expectedOutput, $svc->getCreateSerialization($tag));
    }

    public function getCreateSerializationDataProvider()
    {
        $tag = new \Ftven\SdkTaxonomy\Entity\Tag();
        $tag->setLabel('mon-label');
        $tag->setAuthor('mon-author');

        return [
            [
                new \Ftven\SdkTaxonomy\Entity\Tag(),
                [
                    'label' => null,
                    'author' => null
                ],
            ],
            [
                $tag,
                [
                    'label' => 'mon-label',
                    'author' => 'mon-author'
                ],
            ]
        ];
    }
} 