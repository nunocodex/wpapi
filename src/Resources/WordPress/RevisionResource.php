<?php

namespace NunoCodex\WpApi\Resources\WordPress;

use NunoCodex\WpApi\Resources\EntityResource;

/**
 * Class RevisionResource
 *
 * @package NunoCodex\WpApi\Resources\WordPress
 */
class RevisionResource extends EntityResource
{
    /**
     * @var string
     */
    protected $routeUri = 'posts/%d/revisions/%d';

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get()
    {
        return $this->getClientService()->get($this->getRouteUri());
    }
}