<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 24/11/14
 * Time: 10:33
 */

class GuzzleServiceTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    /**
     * @expectedException \Ftven\SdkTaxonomy\Exception\ApiException
     * @expectedExceptionCode 1234
     * @expectedExceptionMessage erreur post apiException
     */
    public function testPostWillThrowApiExceptionWhenGuzzleRaiseException()
    {
        $exception = new \Exception('erreur', 666);

        $mockRequest = $this->getMock('\Guzzle\Http\Message\Request', array('send'), [], '', false);
        $mockRequest
            ->expects($this->once())
            ->method('send')
            ->willThrowException($exception);

        $mockClient = $this->getMock('Guzzle\Http\Client', array('post'));
        $mockClient
            ->expects($this->once())
            ->method('post')
            ->with('url/uri', ['headers' => null], ['data' => null])
            ->willReturn($mockRequest);

        $mockExceptionSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\ExceptionService', array('getApiException'));
        $mockExceptionSvc
            ->expects($this->once())
            ->method('getApiException')
            ->with($exception)
            ->willReturn(new \Ftven\SdkTaxonomy\Exception\ApiException('erreur post apiException', 1234));

        $svc = new \Ftven\SdkTaxonomy\Service\GuzzleService('url', $mockClient);
        $svc->setExceptionService($mockExceptionSvc);
        $svc->post('/uri', ['data' => null], ['headers' => null]);
    }

    public function testPostWillReturnApiResponse()
    {
        $mockRequest = $this->getMock('\Guzzle\Http\Message\Request', array('send'), [], '', false);
        $mockRequest
            ->expects($this->once())
            ->method('send')
            ->willReturn('OK SEND');

        $mockClient = $this->getMock('Guzzle\Http\Client', array('post'));
        $mockClient
            ->expects($this->once())
            ->method('post')
            ->with('url/uri', ['headers' => null], ['data' => null])
            ->willReturn($mockRequest);

        $svc = new \Ftven\SdkTaxonomy\Service\GuzzleService('url', $mockClient);
        $this->assertEquals('OK SEND', $svc->post('/uri', ['data' => null], ['headers' => null]));
    }

    /**
     * @expectedException \Ftven\SdkTaxonomy\Exception\ApiException
     * @expectedExceptionCode 1234
     * @expectedExceptionMessage erreur get apiException
     */
    public function testGetWillThrowApiExceptionWhenGuzzleRaiseException()
    {
        $exception = new \Exception('erreur', 666);

        $mockRequest = $this->getMock('\Guzzle\Http\Message\Request', array('send'), [], '', false);
        $mockRequest
            ->expects($this->once())
            ->method('send')
            ->willThrowException($exception);

        $mockClient = $this->getMock('Guzzle\Http\Client', array('get'));
        $mockClient
            ->expects($this->once())
            ->method('get')
            ->with('url/uri', ['headers' => null])
            ->willReturn($mockRequest);

        $mockExceptionSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\ExceptionService', array('getApiException'));
        $mockExceptionSvc
            ->expects($this->once())
            ->method('getApiException')
            ->with($exception)
            ->willReturn(new \Ftven\SdkTaxonomy\Exception\ApiException('erreur get apiException', 1234));

        $svc = new \Ftven\SdkTaxonomy\Service\GuzzleService('url', $mockClient);
        $svc->setExceptionService($mockExceptionSvc);
        $svc->get('/uri', ['headers' => null], []);
    }

    public function testGetWillReturnApiResponse()
    {
        $mockResponse = $this->getMock('\Guzzle\Http\Message\Response', array('json'), [], '', false);
        $mockResponse
            ->expects($this->once())
            ->method('json')
            ->willReturn('OK SEND GET');

        $mockRequest = $this->getMock('\Guzzle\Http\Message\Request', array('send'), [], '', false);
        $mockRequest
            ->expects($this->once())
            ->method('send')
            ->willReturn($mockResponse);

        $mockClient = $this->getMock('Guzzle\Http\Client', array('get'));
        $mockClient
            ->expects($this->once())
            ->method('get')
            ->with('url/uri', ['headers' => null])
            ->willReturn($mockRequest);

        $svc = new \Ftven\SdkTaxonomy\Service\GuzzleService('url', $mockClient);
        $this->assertEquals('OK SEND GET', $svc->get('/uri', ['headers' => null], []));
    }

    /**
     * @expectedException \Ftven\SdkTaxonomy\Exception\ApiException
     * @expectedExceptionCode 1234
     * @expectedExceptionMessage erreur delete apiException
     */
    public function testDeleteWillThrowApiExceptionWhenGuzzleRaiseException()
    {
        $exception = new \Exception('erreur', 666);

        $mockRequest = $this->getMock('\Guzzle\Http\Message\Request', array('send'), [], '', false);
        $mockRequest
            ->expects($this->once())
            ->method('send')
            ->willThrowException($exception);

        $mockClient = $this->getMock('Guzzle\Http\Client', array('delete'));
        $mockClient
            ->expects($this->once())
            ->method('delete')
            ->with('url/uri', ['headers' => null])
            ->willReturn($mockRequest);

        $mockExceptionSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\ExceptionService', array('getApiException'));
        $mockExceptionSvc
            ->expects($this->once())
            ->method('getApiException')
            ->with($exception)
            ->willReturn(new \Ftven\SdkTaxonomy\Exception\ApiException('erreur delete apiException', 1234));

        $svc = new \Ftven\SdkTaxonomy\Service\GuzzleService('url', $mockClient);
        $svc->setExceptionService($mockExceptionSvc);
        $svc->delete('/uri', ['headers' => null]);
    }

    public function testDeleteWillReturnApiResponse()
    {
        $mockRequest = $this->getMock('\Guzzle\Http\Message\Request', array('send'), [], '', false);
        $mockRequest
            ->expects($this->once())
            ->method('send')
            ->willReturn('OK SEND DELETE');

        $mockClient = $this->getMock('Guzzle\Http\Client', array('delete'));
        $mockClient
            ->expects($this->once())
            ->method('delete')
            ->with('url/uri', ['headers' => null])
            ->willReturn($mockRequest);

        $svc = new \Ftven\SdkTaxonomy\Service\GuzzleService('url', $mockClient);
        $this->assertEquals('OK SEND DELETE', $svc->delete('/uri', ['headers' => null]));
    }

    /**
     * @expectedException \Ftven\SdkTaxonomy\Exception\ApiException
     * @expectedExceptionCode 1234
     * @expectedExceptionMessage erreur put apiException
     */
    public function testPutWillThrowApiExceptionWhenGuzzleRaiseException()
    {
        $exception = new \Exception('erreur', 666);

        $mockRequest = $this->getMock('\Guzzle\Http\Message\Request', array('send'), [], '', false);
        $mockRequest
            ->expects($this->once())
            ->method('send')
            ->willThrowException($exception);

        $mockClient = $this->getMock('Guzzle\Http\Client', array('put'));
        $mockClient
            ->expects($this->once())
            ->method('put')
            ->with('url/uri', ['headers' => null], ['data' => null])
            ->willReturn($mockRequest);

        $mockExceptionSvc = $this->getMock('\Ftven\SdkTaxonomy\Service\ExceptionService', array('getApiException'));
        $mockExceptionSvc
            ->expects($this->once())
            ->method('getApiException')
            ->with($exception)
            ->willReturn(new \Ftven\SdkTaxonomy\Exception\ApiException('erreur put apiException', 1234));

        $svc = new \Ftven\SdkTaxonomy\Service\GuzzleService('url', $mockClient);
        $svc->setExceptionService($mockExceptionSvc);
        $svc->put('/uri', ['data' => null], ['headers' => null]);
    }

    public function testPutWillReturnApiResponse()
    {
        $mockRequest = $this->getMock('\Guzzle\Http\Message\Request', array('send'), [], '', false);
        $mockRequest
            ->expects($this->once())
            ->method('send')
            ->willReturn('OK SEND PUT');

        $mockClient = $this->getMock('Guzzle\Http\Client', array('put'));
        $mockClient
            ->expects($this->once())
            ->method('put')
            ->with('url/uri', ['headers' => null], ['data' => null])
            ->willReturn($mockRequest);

        $svc = new \Ftven\SdkTaxonomy\Service\GuzzleService('url', $mockClient);
        $this->assertEquals('OK SEND PUT', $svc->put('/uri', ['data' => null], ['headers' => null]));
    }
}
