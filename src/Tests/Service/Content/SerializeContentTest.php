<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 21/11/14
 * Time: 15:12
 */

class SerializeContentTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    /**
     * @dataProvider serializeDataProvider
     */
    public function testSerialize($content, $expectedOutput)
    {
        $svc = new \Ftven\SdkTaxonomy\Service\Content\SerializerContent();
        $this->assertEquals($expectedOutput, $svc->serialize($content));
    }

    public function serializeDataProvider()
    {
        $content = new \Ftven\SdkTaxonomy\Entity\Content();
        $content->setUri('mon-uri');
        $content->setType('mon-type');
        $content->setTags('mon-tag');
        $content->setAuthor('mon-author');

        return [
          [
              new \Ftven\SdkTaxonomy\Entity\Content(),
              [
                  'uri' => null,
                  'type' => null,
                  'tags' => [],
                  'author' => null,
              ]
          ],
          [
              $content,
              [
                  'uri' => 'mon-uri',
                  'type' => 'mon-type',
                  'tags' => 'mon-tag',
                  'author' => 'mon-author',
              ]
          ]
        ];
    }

    /**
     * @dataProvider serializeSearchDataProvider
     */
    public function testSerializeSearch($tags, $synonym, $children, $page, $limit, $expectedOutput)
    {
        $svc = new \Ftven\SdkTaxonomy\Service\Content\SerializerContent();
        $this->assertEquals($expectedOutput, $svc->serializeSearch($tags, $synonym, $children, $page, $limit));
    }

    public function serializeSearchDataProvider()
    {
        return [
            [
                ['tag1', 'tag2'],
                false,
                false,
                1,
                100,
                [
                    'tags' => 'tag1,tag2',
                    'synonyms' => false,
                    'children' => false,
                    'page' => 1,
                    'limit' => 100
                ]
            ],
            [
                ['tag1'],
                true,
                false,
                2,
                400,
                [
                    'tags' => 'tag1',
                    'synonyms' => true,
                    'children' => false,
                    'page' => 2,
                    'limit' => 400
                ]
            ],
            [
                ['tag1'],
                false,
                true,
                3,
                200,
                [
                    'tags' => 'tag1',
                    'synonyms' => false,
                    'children' => true,
                    'page' => 3,
                    'limit' => 200
                ]
            ]
        ];
    }
} 