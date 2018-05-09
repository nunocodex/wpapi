<?php

namespace NunoCodex\WpApi\Resources\WordPress;

use NunoCodex\WpApi\Resources\CollectionResource;

/**
 * Class RevisionsResource
 *
 * @package NunoCodex\WpApi\Resources\WordPress
 */
class RevisionsResource extends CollectionResource
{
    /**
     * @var string
     */
    protected $routeUri = 'posts/%d/revisions';

    /**
     * @param int $id
     * @return RevisionResource
     */
    public function id(int $id)
    {
        return new RevisionResource($this->getClientService(), $this->getId(), $id);
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