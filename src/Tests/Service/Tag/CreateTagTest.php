<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 21/11/14
 * Time: 15:47
 */

class CreateTagTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    public function testExecute()
    {
        $tag = new \Ftven\SdkTaxonomy\Entity\Tag();

        $mockResponse = $this->getMock('\Guzzle\Http\Message\Response', array('json'), array(), '', false);
        $mockResponse
            ->expects($this->once())
            ->method('json')
            ->willReturn(json_encode(['aa' => 'bb']));

        $mockGuzzleService = $this->getMock('\Ftven\SdkTaxonomy\Service\GuzzleService', array('post'));
        $mockGuzzleService
            ->expects($this->once())
            ->method('post')
            ->with('/tags', ['tag-serialize'], ['Content-Type' => 'application/json', 'headers' => 'les-headers'])
            ->willReturn($mockResponse);

        $mockAccessTokenSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\AccessTokenService', array('getHeaders'));
        $mockAccessTokenSvc
            ->expects($this->once())
            ->method('getHeaders')
            ->willReturn(['headers' => 'les-headers']);

        $mockMapperSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\Tag\MapperTag', array('populateTag'));
        $mockMapperSvc
            ->expects($this->once())
            ->method('populateTag')
            ->with($tag,  json_encode(['aa' => 'bb']))
            ->willReturn(true);

        $mockSerialiserSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\Tag\SerializerTag', array('getCreateSerialization'));
        $mockSerialiserSvc
            ->expects($this->once())
            ->method('getCreateSerialization')
            ->with($tag)
            ->willReturn(['tag-serialize']);

        $svc = new \Ftven\SdkTaxonomy\Service\Tag\CreateTag();
        $svc->setGuzzleSvc($mockGuzzleService);
        $svc->setAccessTokenSvc($mockAccessTokenSvc);
        $svc->setMapperSvc($mockMapperSvc);
        $svc->setSerializerSvc($mockSerialiserSvc);
        $svc->execute($tag);
    }
}
