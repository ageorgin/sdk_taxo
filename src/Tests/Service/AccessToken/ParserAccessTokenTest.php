<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 21/11/14
 * Time: 12:08
 */

class ParserAccessTokenTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    /**
     * @expectedException \Ftven\SdkTaxonomy\Exception\SdkException
     * @expectedExceptionMessage unable to parse X-FTVEN-ID header with value [blabla]
     */
    public function testParseXFtvenIdRaiseExceptionIdIfParameterBadFormatted()
    {
        $svc = new \Ftven\SdkTaxonomy\Service\AccessToken\ParserAccessToken();
        $svc->parseXFtvenId('blabla');
    }

    public function testParseXFtvenIdDoTheJob()
    {
        $svc = new \Ftven\SdkTaxonomy\Service\AccessToken\ParserAccessToken();
        $ret = $svc->parseXFtvenId('id: mon-id, expire: date-expire, token: mon-token');

        $this->assertEquals(
            [
                'id' => 'mon-id',
                'expire' => 'date-expire',
                'token' => 'mon-token'
            ],
            $ret
        );
    }
} 