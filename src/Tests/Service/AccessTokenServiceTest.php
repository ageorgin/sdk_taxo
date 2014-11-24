<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 21/11/14
 * Time: 16:36
 */

class AccessTokenServiceTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    public function testCheckAccessTokenWillCallGenerateaccesstokenIfTokenHasExpired()
    {
        $svc = $this->getMock('\Ftven\SdkTaxonomy\Service\AccessTokenService', array('generateAccessToken'));
        $svc
            ->expects($this->once())
            ->method('generateAccessToken')
            ->willReturn(true);

        $accessToken = new \Ftven\SdkTaxonomy\Entity\AccessToken();
        $accessToken->setToken('AAAA');
        $accessToken->setExpire(new \DateTime('2014-11-01 00:00:00'));
        $svc->setAccessToken($accessToken);
        $svc->checkAccessToken();
    }

    public function testCheckAccessTokenWillCallGenerateaccesstokenIfTokenIsNotSet()
    {
        $svc = $this->getMock('\Ftven\SdkTaxonomy\Service\AccessTokenService', array('generateAccessToken'));
        $svc
            ->expects($this->once())
            ->method('generateAccessToken')
            ->willReturn(true);

        $accessToken = new \Ftven\SdkTaxonomy\Entity\AccessToken();
        $tomorrow = new \DateTime();
        $tomorrow->add(new \DateInterval('P1D'));
        $accessToken->setExpire($tomorrow);
        $svc->setAccessToken($accessToken);
        $svc->checkAccessToken();
    }

    public function testCheckAccessTokenWillDoNothingIfTokenExistsAndNotExpired()
    {
        $svc = $this->getMock('\Ftven\SdkTaxonomy\Service\AccessTokenService', array('generateAccessToken'));
        $svc
            ->expects($this->never())
            ->method('generateAccessToken')
            ->willReturn(true);

        $accessToken = new \Ftven\SdkTaxonomy\Entity\AccessToken();
        $accessToken->setToken('AAAA');
        $tomorrow = new \DateTime();
        $tomorrow->add(new \DateInterval('P1D'));
        $accessToken->setExpire($tomorrow);
        $svc->setAccessToken($accessToken);
        $svc->checkAccessToken();
    }

    public function testGetHeaders()
    {
        $svc = $this->getMock('\Ftven\SdkTaxonomy\Service\AccessTokenService', array('checkAccessToken'));
        $svc
            ->expects($this->once())
            ->method('checkAccessToken')
            ->willReturn(true);

        $accessToken = new \Ftven\SdkTaxonomy\Entity\AccessToken();
        $accessToken->setId('id');
        $accessToken->setToken('AAAA');
        $accessToken->setExpire(new \DateTime('2014-11-01 00:00:00'));
        $svc->setAccessToken($accessToken);

        $this->assertEquals(
            [
                'X-FTVEN-ID' => 'id: id, expire: 2014-11-01T00:00:00+0100, token: AAAA'
            ],
            $svc->getHeaders()
        );
    }

    public function testGenerateAccessToken()
    {
        $accessTokenInput = new \Ftven\SdkTaxonomy\Entity\AccessToken();
        $accessTokenOutput = new \Ftven\SdkTaxonomy\Entity\AccessToken();
        $accessTokenOutput->setId('id');
        $now = new \DateTime();
        $accessTokenOutput->setExpire($now);
        $accessTokenOutput->setToken('tolkien');

        $mockGenerateSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\AccessToken\GenerateAccessToken', array('execute'));
        $mockGenerateSvc
            ->expects($this->once())
            ->method('execute')
            ->with($accessTokenInput)
            ->willReturn($accessTokenOutput);

        $svc = new \Ftven\SdkTaxonomy\Service\AccessTokenService();
        $svc->setAccessToken($accessTokenInput);
        $svc->setGenerateService($mockGenerateSvc);
        $this->getResultFromMethod($svc, 'generateAccessToken', []);
        $this->assertEquals($accessTokenOutput, $svc->getAccessToken());
    }
} 