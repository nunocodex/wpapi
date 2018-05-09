<?php

namespace NunoCodex\WpApi\Traits;

use NunoCodex\WpApi\Services\ClientService;

/**
 * Trait FiltersTrait
 *
 * @package NunoCodex\WpApi\Traits
 */
trait FiltersTrait
{
    /**
     * @param array $params
     * @return $this
     */
    private function buildFilter(array $params)
    {
        // todo: error handler?
        if (! method_exists($this, 'getClientService')) {
            return $this;
        }

        /** @var ClientService $clientService */
        $clientService = $this->getClientService();

        foreach ($params as $key => $value) {
            $clientService->setQuery([
                $key => $value
            ]);
        }

        return $this;
    }

    /**
     * @param array $params
     * @return FiltersTrait
     */
    public function filter(array $params)
    {
        return $this->buildFilter([
            'filter' => $params
        ]);
    }

    /**
     * @return FiltersTrait
     */
    public function embed()
    {
        return $this->buildFilter([
            '_embed' => true
        ]);
    }

    /**
     * @param int|null $id
     * @return FiltersTrait
     */
    public function author(int $id = null)
    {
        return $this->buildFilter([
            'author' => $id
        ]);
    }

    /**
     * @param array|string $status
     * @return FiltersTrait
     */
    public function status($status)
    {
        return $this->buildFilter([
            'status' => $status
        ]);
    }

    /**
     * @param bool $sticky
     * @return FiltersTrait
     */
    public function sticky(bool $sticky = true)
    {
        return $this->buildFilter([
            'sticky' => $sticky
        ]);
    }

    /**
     * @param string $slug
     * @return FiltersTrait
     */
    public function slug(string $slug)
    {
        return $this->buildFilter([
            'slug' => $slug
        ]);
    }

    /**
     * @param string $password
     * @return FiltersTrait
     */
    public function password(string $password)
    {
        return $this->buildFilter([
            'password' => $password
        ]);
    }

    /**
     * @param int $perPage
     * @return FiltersTrait
     */
    public function perPage(int $perPage)
    {
        return $this->buildFilter([
            'per_page' => $perPage
        ]);
    }

    /**
     * @param int $page
     * @return FiltersTrait
     */
    public function page(int $page)
    {
        return $this->buildFilter([
            'page' => $page
        ]);
    }

    /**
     * @param int $offset
     * @return FiltersTrait
     */
    public function offset(int $offset)
    {
        return $this->buildFilter([
            'offset' => $offset
        ]);
    }

    /**
     * @param string $order
     * @return FiltersTrait
     */
    public function order(string $order = 'asc')
    {
        return $this->buildFilter([
            'order' => $order
        ]);
    }

    /**
     * @param string $orderBy
     * @return FiltersTrait
     */
    public function orderBy(string $orderBy = 'date')
    {
        return $this->buildFilter([
            'orderby' => $orderBy
        ]);
    }
}