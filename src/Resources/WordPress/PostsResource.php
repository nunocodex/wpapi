<?php

namespace NunoCodex\WpApi\Resources\WordPress;

use NunoCodex\WpApi\Resources\CollectionResource;

/**
 * Class PostsResource
 *
 * @package NunoCodex\WpApi\Resources\WordPress
 */
class PostsResource extends CollectionResource
{
    /**
     * @var string
     */
    protected $routeUri = 'posts';

    /**
     * @param int $id
     * @return PostResource
     */
    public function id(int $id)
    {
        return new PostResource($this->getClientService(), $id);
    }

    /**
     * @param int|null $page
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $page = null)
    {
        return $this->getClientService()->get($this->getRouteUri(), ['page' => $page]);
    }

}