<?php

namespace NunoCodex\WpApi;

use NunoCodex\WpApi\Resources\WordPress\PostsResource;
use NunoCodex\WpApi\Services\ClientService;

/**
 * Class WpApi
 *
 * @package NunoCodex\WpApi
 */
class WpApi
{
    const ROUTE_INDEX           = '';
    const ROUTE_POSTS           = 'posts';
    const ROUTE_POST            = 'posts/%d';
    const ROUTE_POST_REVISIONS  = 'posts/%d/revisions';
    const ROUTE_POST_REVISION   = 'posts/%d/revisions/%d';
    const ROUTE_PAGES           = 'pages';
    const ROUTE_PAGE            = 'pages/%d';
    const ROUTE_MEDIAS          = 'media';
    const ROUTE_MEDIA           = 'media/%d';
    const ROUTE_TYPES           = 'types';
    const ROUTE_TYPE            = 'types/%d';
    const ROUTE_STATUSES        = 'statuses';
    const ROUTE_STATUS          = 'statuses/%d';
    const ROUTE_COMMENTS        = 'comments';
    const ROUTE_COMMENT         = 'comments/%d';
    const ROUTE_TAXONOMIES      = 'taxonomies';
    const ROUTE_TAXONOMY        = 'taxonomies/%d';
    const ROUTE_CATEGORIES      = 'categories';
    const ROUTE_CATEGORY        = 'categories/%d';
    const ROUTE_TAGS            = 'tags';
    const ROUTE_TAG             = 'tags/%d';
    const ROUTE_USERS           = 'users';
    const ROUTE_USER            = 'users/%d';
    const ROUTE_USER_ME         = 'users/me';
    const ROUTE_SETTINGS        = 'settings';

    const ROUTE_ACF_OPTIONS     = 'options/%s';

    /**
     * @var array
     */
    private $params = [];

    /**
     * WpApi constructor.
     *
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->setParams($params);
    }

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = array_merge($this->getParams(), $params);
    }

    /**
     * @param string $key
     * @param $value
     */
    public function setParam(string $key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function getParam(string $key, $default = null)
    {
        return (isset($this->params[$key])) ? $this->params[$key] : $default;
    }

    /**
     * @param array $options
     * @return ClientService
     */
    public function getClient(array $options = [])
    {
        return new ClientService($options);
    }

    /* ----------------------------------------------------------------------------------- */

    /**
     * @return PostsResource
     */
    public function posts()
    {
        return new PostsResource($this->getClient($this->getParam('client')));
    }
}
