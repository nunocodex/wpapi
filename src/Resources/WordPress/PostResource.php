<?php

namespace NunoCodex\WpApi\Resources\WordPress;

use NunoCodex\WpApi\Resources\EntityResource;

/**
 * Class PostResource
 *
 * @package NunoCodex\WpApi\Resources\WordPress
 */
class PostResource extends EntityResource
{
    /**
     * @var string
     */
    protected $routeUri = 'posts/%d';

    /**
     * @param int|null $id
     * @return RevisionsResource
     */
    public function revisions(int $id = null)
    {
        return new RevisionsResource($this->getClientService(), $this->getId(), $id);
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get()
    {
        return $this->getClientService()->get($this->getRouteUri());
    }
}