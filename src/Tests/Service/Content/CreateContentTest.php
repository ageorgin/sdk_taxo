<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 21/11/14
 * Time: 14:22
 */


class CreateContentTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    public function testExecute()
    {
        $content = new \Ftven\SdkTaxonomy\Entity\Content();

        $mockResponse = $this->getMock('\Guzzle\Http\Message\Response', array('json'), array(), '', false);
        $mockResponse
            ->expects($this->once())
            ->method('json')
            ->willReturn(json_encode(['aa' => 'bb']));

        $mockGuzzleService = $this->getMock('\Ftven\SdkTaxonomy\Service\GuzzleService', array('post'));
        $mockGuzzleService
            ->expects($this->once())
            ->method('post')
            ->with('/contents', ['content-serialize'], ['Content-Type' => 'application/json', 'headers' => 'les-headers'])
            ->willReturn($mockResponse);

        $mockSerializerSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\Content\SerializerContent', array('serialize'));
        $mockSerializerSvc
            ->expects($this->once())
            ->method('serialize')
            ->willReturn(['content-serialize']);

        $mockMapperSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\Content\MapperContent', array('populateContent'));
        $mockMapperSvc
            ->expects($this->once())
            ->method('populateContent')
            ->with($content, json_encode(['aa' => 'bb']))
            ->willReturn(true);

        $mockAccessTokenSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\AccessTokenService', array('getHeaders'));
        $mockAccessTokenSvc
            ->expects($this->once())
            ->method('getHeaders')
            ->willReturn(['headers' => 'les-headers']);

        $svc = new \Ftven\SdkTaxonomy\Service\Content\CreateContent();
        $svc->setGuzzleSvc($mockGuzzleService);
        $svc->setMapperSvc($mockMapperSvc);
        $svc->setSerialiserSvc($mockSerializerSvc);
        $svc->setAccessTokenSvc($mockAccessTokenSvc);
        $svc->execute($content);
    }
} 