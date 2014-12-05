<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 17/11/14
 * Time: 11:22
 */

namespace Ftven\SdkTaxonomy\Service;

use Guzzle\Http\Client;
use Guzzle\Http\ClientInterface;

class GuzzleService implements GuzzleServiceInterface
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    private $url;

    /**
     * @var ExceptionServiceInterface
     */
    private $exceptionService = null;

    public function __construct($url = null, ClientInterface $client = null)
    {
        if (null === $client) {
            $client = new Client();
        }
        $this->client = $client;

        $this->url = $url;
    }

    /**
     * Send a PUT request
     *
     * @param string|array|Url $uri URL or URI template
     * @param array $options Array of request options to apply.
     *
     * @return ResponseInterface
     * @throws RequestException When an error is encountered
     */
    public function post($uri = null, array $data = null, array $headers = [])
    {
        $request = $this->client->post($this->getUrl() . $uri, $headers, $data);

        try {
            $result = $request->send();
        } catch (\Exception $e) {
            $apiException = $this->getExceptionService()->getApiException($e);
            throw $apiException;
        }

        return $result;
    }

    /**
     * Send a GET request
     *
     * @param string|array|Url $uri URL or URI template
     *
     * @return ResponseInterface
     * @throws RequestException When an error is encountered
     */
    public function get($uri = null, $headers = [], $params = [])
    {
        $request = $this->client->get($this->getUrl() . $uri, $headers);
        foreach ($params as $key => $value) {
            $request->getQuery()->add($key, $value);
        }

        try {
            $result = $request->send();
        } catch (\Exception $e) {
            $apiException = $this->getExceptionService()->getApiException($e);
            throw $apiException;
        }

        return $result->json();
    }

    /**
     * Send a DELETE request
     *
     * @param string|array|Url $uri URL or URI template
     *
     * @return ResponseInterface
     * @throws RequestException When an error is encountered
     */
    public function delete($uri = null, array $headers = [])
    {
        $request = $this->client->delete($this->getUrl() . $uri, $headers);

        try {
            $result = $request->send();
        } catch (\Exception $e) {
            $apiException = $this->getExceptionService()->getApiException($e);
            throw $apiException;
        }

        return $result;
    }

    /**
     * @param $uri
     * @param array $data
     * @param array $headers
     * @return mixed
     */
    public function put($uri, array $data = [], array $headers = [])
    {
        $request = $this->client->put($this->getUrl() . $uri, $headers, $data);

        try {
            $result = $request->send();
        } catch (\Exception $e) {
            $apiException = $this->getExceptionService()->getApiException($e);
            throw $apiException;
        }

        return $result;
    }


    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param \Ftven\SdkTaxonomy\Service\ExceptionServiceInterface $exceptionService
     */
    public function setExceptionService($exceptionService)
    {
        $this->exceptionService = $exceptionService;
    }

    /**
     * @return \Ftven\SdkTaxonomy\Service\ExceptionServiceInterface
     */
    public function getExceptionService()
    {
        return $this->exceptionService;
    }
}
