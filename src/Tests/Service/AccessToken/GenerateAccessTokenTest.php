<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 21/11/14
 * Time: 11:42
 */


class GenerateAccessTokenTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    /**
     * @expectedException \Ftven\SdkTaxonomy\Exception\ApiException
     * @expectedExceptionMessage No header X-FTVEN-ID received
     */
    public function testExecuteRaiseExceptionWhenApiReturnNoHeader()
    {
        $mockGuzzleSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\GuzzleService', array('post'));
        $mockGuzzleSvc
            ->expects($this->once())
            ->method('post')
            ->willReturn(new \Guzzle\Http\Message\Response('201'));

        $svc = new \Ftven\SdkTaxonomy\Service\AccessToken\GenerateAccessToken();
        $svc->setGuzzleService($mockGuzzleSvc);
        $svc->execute(new \Ftven\SdkTaxonomy\Entity\AccessToken());
    }

    public function testExecute()
    {
        $now = new \DateTime();

        $mockGuzzleSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\GuzzleService', array('post'));
        $mockGuzzleSvc
            ->expects($this->once())
            ->method('post')
            ->willReturn(new \Guzzle\Http\Message\Response('201', array('X-FTVEN-ID' => ('blabla'))));

        $mockParserSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\AccessToken\ParserAccessToken');
        $mockParserSvc
            ->expects($this->once())
            ->method('parseXFtvenId')
            ->with('blabla')
            ->willReturn([
                'id' => 'mon-id',
                'expire' => $now->format('Y-m-d H:i:s'),
                'token' => 'mon-token'
            ]);

        $svc = new \Ftven\SdkTaxonomy\Service\AccessToken\GenerateAccessToken();
        $svc->setGuzzleService($mockGuzzleSvc);
        $svc->setParserService($mockParserSvc);
        $accessToken = new \Ftven\SdkTaxonomy\Entity\AccessToken();
        $svc->execute($accessToken);

        $this->assertEquals('mon-id', $accessToken->getId());
        $this->assertEquals($now, $accessToken->getExpire());
        $this->assertEquals('mon-token', $accessToken->getToken());
    }
}
