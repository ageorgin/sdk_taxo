<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 17/11/14
 * Time: 11:22
 */

class GuzzleService implements GuzzleServiceInterface
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    private $url;

    public function __construct($url = null, \GuzzleHttp\ClientInterface $client = null)
    {
        if (null === $client) {
            $client = new \GuzzleHttp\Client();
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
    public function post($uri = null, array $data = [], array $headers = [])
    {
        $options = ['json' => $data, 'headers' => $headers];
        $result = $this->client->post($this->getUrl() . $uri, $options);

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
    public function get($uri = null)
    {
        $result = $this->client->get($this->getUrl() . $uri);

        return $result;
    }

    /**
     * Send a DELETE request
     *
     * @param string|array|Url $uri URL or URI template
     *
     * @return ResponseInterface
     * @throws RequestException When an error is encountered
     */
    public function delete($uri = null)
    {
        $result = $this->client->delete($this->getUrl() . $uri);

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
        if (null === $this->url) {
            $this->url = 'http://api-taxonomie.ftv-preprod.fr';
        }
        return $this->url;
    }
} 