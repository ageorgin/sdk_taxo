<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 26/11/14
 * Time: 12:18
 */

class ReadTagTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    public function testExecute()
    {
        $mockGuzzleService = $this->getMock('\Ftven\SdkTaxonomy\Service\GuzzleService', array('get'));
        $mockGuzzleService
            ->expects($this->once())
            ->method('get')
            ->with('/tags/666', ['headers' => 'les-headers'], [])
            ->willReturn('getTags');

        $mockAccessTokenSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\AccessTokenService', array('getHeaders'));
        $mockAccessTokenSvc
            ->expects($this->once())
            ->method('getHeaders')
            ->willReturn(['headers' => 'les-headers']);

        $mockMapperSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\Tag\MapperTag', array('populateTag'));
        $mockMapperSvc
            ->expects($this->once())
            ->method('populateTag')
            ->willReturn('OK getTags');

        $svc = new \Ftven\SdkTaxonomy\Service\Tag\ReadTag();
        $svc->setGuzzleSvc($mockGuzzleService);
        $svc->setAccessTokenSvc($mockAccessTokenSvc);
        $svc->setMapperSvc($mockMapperSvc);

        $svc->execute(666);
    }
} 