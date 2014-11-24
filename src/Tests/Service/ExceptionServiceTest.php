<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 24/11/14
 * Time: 09:52
 */

class ExceptionServiceTest extends \Ftven\SdkTaxonomy\Tests\PHPUnitAbstract
{
    public function testGetApiExceptionWillUseExceptionCodeAndMessageIfNoMethodGetresponseExists()
    {
        $svc = new \Ftven\SdkTaxonomy\Service\ExceptionService();
        $exception = $svc->getApiException(new \Exception('message exception', 666));

        $this->assertInstanceOf('\Ftven\SdkTaxonomy\Exception\ApiException', $exception);
        $this->assertEquals(666, $exception->getCode());
        $this->assertEquals('message exception', $exception->getMessage());
    }

    /**
     * @dataProvider getApiExceptionDataProvider
     */
    public function testGetApiExceptionWillUseResponseBodyCodeAndMessage($exceptionCode, $exceptionMessage, $bodyCode, $bodyMessage)
    {
        $response = new \Guzzle\Http\Message\Response(404);
        $response->setBody(json_encode([
            'error' => [
                'code' => $bodyCode,
                'message' => $bodyMessage
            ]
        ]));
        $originException = new \Guzzle\Http\Exception\ClientErrorResponseException($exceptionMessage, $exceptionCode);
        $originException->setResponse($response);

        $svc = new \Ftven\SdkTaxonomy\Service\ExceptionService();
        $exception = $svc->getApiException($originException);

        $this->assertInstanceOf('\Ftven\SdkTaxonomy\Exception\ApiException', $exception);
        if (null === $bodyCode) {
            $this->assertEquals($exceptionCode, $exception->getCode());
        } else {
            $this->assertEquals($bodyCode, $exception->getCode());
        }

        if (null === $bodyMessage) {
            $this->assertEquals($exceptionMessage, $exception->getMessage());
        } else {
            $this->assertEquals($bodyMessage, $exception->getMessage());
        }
    }

    public function getApiExceptionDataProvider()
    {
        return [
            [666, 'message exception', null, null],
            [666, 'message exception', 123456789, null],
            [666, 'message exception', null, 'body message'],
            [666, 'message exception', 123456789, 'body message'],
        ];
    }
} 