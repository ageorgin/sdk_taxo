<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 21/11/14
 * Time: 15:31
 */


class AutocompleteTagTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    /**
     * @dataProvider executeDataProvider
     */
    public function testExecute($filter, $sort)
    {
        $params = [];
        if (null !== $sort) {
            $params['sort'] = $sort;
        }

        $mockGuzzleService = $this->getMock('\Ftven\SdkTaxonomy\Service\GuzzleService', array('get'));
        $mockGuzzleService
            ->expects($this->once())
            ->method('get')
            ->with('/tags/autocomplete/' . $filter, ['headers' => 'les-headers'], $params)
            ->willReturn(['reponse1', 'reponse2']);

        $mockAccessTokenSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\AccessTokenService', array('getHeaders'));
        $mockAccessTokenSvc
            ->expects($this->once())
            ->method('getHeaders')
            ->willReturn(['headers' => 'les-headers']);

        $mockMapperSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\Tag\MapperTag', array('getTags'));
        $mockMapperSvc
            ->expects($this->once())
            ->method('getTags')
            ->with(['reponse1', 'reponse2'])
            ->willReturn(true);

        $svc = new \Ftven\SdkTaxonomy\Service\Tag\AutocompleteTag();
        $svc->setGuzzleSvc($mockGuzzleService);
        $svc->setAccessTokenSvc($mockAccessTokenSvc);
        $svc->setMapperSvc($mockMapperSvc);
        $svc->execute($filter, $sort);
    }

    public function executeDataProvider()
    {
        return [
            ['aaa', null],
            ['bricolo', 'type']
        ];
    }
} 