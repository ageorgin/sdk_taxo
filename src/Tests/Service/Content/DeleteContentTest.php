<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 21/11/14
 * Time: 14:40
 */

class DeleteContentTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    public function testExecute()
    {
        $mockGuzzleService = $this->getMock('\Ftven\SdkTaxonomy\Service\GuzzleService', array('delete'));
        $mockGuzzleService
            ->expects($this->once())
            ->method('delete')
            ->with('/contents/666', ['headers' => 'les-headers'])
            ->willReturn(true);

        $mockAccessTokenSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\AccessTokenService', array('getHeaders'));
        $mockAccessTokenSvc
            ->expects($this->once())
            ->method('getHeaders')
            ->willReturn(['headers' => 'les-headers']);

        $svc = new \Ftven\SdkTaxonomy\Service\Content\DeleteContent();
        $svc->setAccessTokenSvc($mockAccessTokenSvc);
        $svc->setGuzzleSvc($mockGuzzleService);
        $svc->execute(new \Ftven\SdkTaxonomy\Entity\Content(666));
    }
}
