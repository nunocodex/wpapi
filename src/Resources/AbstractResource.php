<?php

namespace NunoCodex\WpApi\Resources;

use NunoCodex\WpApi\Services\ClientService;
use NunoCodex\WpApi\Traits\FiltersTrait;

/**
 * Class AbstractResource
 *
 * @package NunoCodex\WpApi\Resources
 */
abstract class AbstractResource
{
    /**
     * @var ClientService
     */
    protected $clientService;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $subId;

    /**
     * @var string
     */
    protected $routeUri;

    /**
     * @var array
     */
    protected $routeParams = [];

    /**
     * AbstractResource constructor.
     *
     * @param ClientService $clientService
     * @param int|null $id
     * @param int|null $subId
     */
    public function __construct(ClientService $clientService, int $id = null, int $subId = null)
    {
        $this->setClientService($clientService);

        if (is_int($id)) {
            $this->setId($id);
        }

        if (is_int($subId)) {
            $this->setSubId($subId);
        }
    }

    /**
     * @return ClientService
     */
    public function getClientService()
    {
        return $this->clientService;
    }

    /**
     * @param ClientService $clientService
     */
    public function setClientService(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $uri = $this->getClientService()->getClient()->getConfig('base_uri')->__toString();

        return $uri . $this->getRouteUri();
    }

    /**
     * @return int
     */
    protected function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    protected function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    protected function getSubId()
    {
        return $this->subId;
    }

    /**
     * @param int $subId
     */
    protected function setSubId(int $subId)
    {
        $this->subId = $subId;
    }

    /**
     * @param string $route
     * @param array $args
     * @return string
     */
    protected function parseRoute(string $route, array $args = [])
    {
        return sprintf($route, ...$args);
    }

    /**
     * @return string
     */
    protected function getRouteUri()
    {
        return $this->parseRoute($this->routeUri, $this->getRouteParams());
    }

    /**
     * @return array
     */
    protected function getRouteParams()
    {
        return (count($this->routeParams)) ?: [$this->getId(), $this->getSubId()];
    }
}