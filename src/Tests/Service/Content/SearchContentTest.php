<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 21/11/14
 * Time: 15:01
 */

class SearchContentTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    public function testExecute()
    {
        $response = [
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
        ];

        $mockGuzzleService = $this->getMock('\Ftven\SdkTaxonomy\Service\GuzzleService', array('get'));
        $mockGuzzleService
            ->expects($this->once())
            ->method('get')
            ->with('/contents/', ['headers' => 'les-headers'], ['serialize-search'])
            ->willReturn($response);

        $mockSerializerSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\Content\SerializerContent', array('serializeSearch'));
        $mockSerializerSvc
            ->expects($this->once())
            ->method('serializeSearch')
            ->willReturn(['serialize-search']);

        $mockMapperSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\Content\MapperContent', array('getContents'));
        $mockMapperSvc
            ->expects($this->once())
            ->method('getContents')
            ->with($response)
            ->willReturn('OK getContents');

        $mockAccessTokenSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\AccessTokenService', array('getHeaders'));
        $mockAccessTokenSvc
            ->expects($this->once())
            ->method('getHeaders')
            ->willReturn(['headers' => 'les-headers']);

        $svc = new \Ftven\SdkTaxonomy\Service\Content\SearchContent();
        $svc->setGuzzleSvc($mockGuzzleService);
        $svc->setMapperSvc($mockMapperSvc);
        $svc->setSerialiserSvc($mockSerializerSvc);
        $svc->setAccessTokenSvc($mockAccessTokenSvc);
        $this->assertEquals('OK getContents', $svc->execute(['tag1', 'tag2']));
    }
} 