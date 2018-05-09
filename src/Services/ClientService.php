<?php

namespace NunoCodex\WpApi\Services;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;

/**
 * Class ClientService
 *
 * @package NunoCodex\WpApi\Services
 */
class ClientService
{
    /**
     * @var ClientInterface|Client
     */
    private $client;

    /**
     * @var array
     */
    private $options = [];

    /**
     * @var array
     */
    private $query = [];

    /**
     * ClientService constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;

        $this->setClient(new Client($options));
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param string $uri
     * @param array $query
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $uri, array $query = [])
    {
        return $this->request('GET', $uri, $query);
    }

    /**
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $query
     * @param bool $clear
     * @return array
     */
    public function getQuery(array $query = [], bool $clear = false)
    {
        if (count($query)) {
            $this->setQuery($query, $clear);
        } elseif (true === $clear) {
            $this->clearQuery();
        }

        return $this->query;
    }

    /**
     * @param array $query
     * @param bool $clear
     */
    public function setQuery(array $query, bool $clear = false)
    {
        if (true === $clear) {
            $this->clearQuery();
        }

        $this->query = array_merge($this->getQuery(), $query);
    }

    /**
     *
     */
    public function clearQuery()
    {
        $this->query = [];
    }


    /**
     * @param string $method
     * @param string $uri
     * @param array $query
     * @param bool $clear
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $method, string $uri, array $query = [], bool $clear = false)
    {
        try {
            $query = [
                'query' => $this->getQuery($query, $clear)
            ];

            $response = $this->getClient()->request($method, $uri, $query);

            $return = [
                'results'   => json_decode((string) $response->getBody(), true),
                'total'     => $response->getHeaderLine('X-WP-Total'),
                'pages'     => $response->getHeaderLine('X-WP-TotalPages')
            ];
        } catch (RequestException $e) {
            $error['message'] = $e->getMessage();

            if ($e->getResponse()) {
                $error['code'] = $e->getResponse()->getStatusCode();
            }

            $return = [
                'error'     => $error,
                'results'   => [],
                'total'     => 0,
                'pages'     => 0
            ];
        }

        return $return;
    }
}