<?php

namespace NunoPress\WpApi;

/**
 * Class WpApi
 *
 * @package NunoPress\WpApi
 */
class WpApi
{
    const ROUTE_BASE            = 'wp-json/';
    const ROUTE_WP              = 'wp/v2/';
    const ROUTE_ACF             = 'acf/v2/';

    const ROUTE_INDEX           = '';
    const ROUTE_POSTS           = 'posts';
    const ROUTE_POST            = 'posts/%d';
    const ROUTE_POST_REVISIONS = 'posts/%d/revisions';
    const ROUTE_POST_REVISION  = 'posts/%d/revisions/%d';
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

    const ROUTE_ACF_OPTIONS     = 'options';

    /**
     * @var string
     */
    private $client;

    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $params = [];

    /**
     * WpApi constructor.
     *
     * @param WpApiClientInterface $client
     */
    public function __construct(WpApiClientInterface $client)
    {
        $this->client = $client;
    }

    /* ----------------------------------------------------------------------------------- */

    /**
     * @param array $params
     *
     * @return $this
     */
    public function filter(array $params)
    {
        foreach ($params as $k => $v) {
            $this->params['filter'][ $k ] = $v;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function embed()
    {
        $this->params['_embed'] = true;

        return $this;
    }

    /**
     * @param int $num
     *
     * @return $this
     */
    public function pagination(int $num)
    {
        $this->params['page'] = $num;

        return $this;
    }

    /* ----------------------------------------------------------------------------------- */

    /**
     * @api GET /
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function base()
    {
        $this->setBaseUrl(self::ROUTE_INDEX);

        return $this;
    }

    /**
     * @api GET /wp/v2/
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function index()
    {
        $this->setWpUrl(self::ROUTE_INDEX);

        return $this;
    }

    /**
     * @api GET|POST /wp/v2/posts
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function posts()
    {
        $this->setWpUrl(self::ROUTE_POSTS);

        return $this;
    }

    /**
     * @api GET|POST|DELETE /wp/v2/posts/<id>
     *
     * @param int $id
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function post(int $id)
    {
        $this->setWpUrl(self::ROUTE_POST, [ $id ]);

        return $this;
    }

    /**
     * @api GET /wp/v2/posts/<parent_id>/revisions
     *
     * @param int $id
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function postRevisions(int $id)
    {
        $this->setWpUrl(self::ROUTE_POST_REVISIONS, [ $id ]);

        return $this;
    }

    /**
     * @api GET|DELETE /wp/v2/posts/<parent_id>/revisions/<id>
     *
     * @param int $postID
     * @param int $revisionID
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function postRevision(int $postID, int $revisionID)
    {
        $this->setWpUrl(self::ROUTE_POST_REVISION, [ $postID, $revisionID ]);

        return $this;
    }

    /**
     * @api GET|POST /wp/v2/pages
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function pages()
    {
        $this->setWpUrl(self::ROUTE_PAGES);

        return $this;
    }

    /**
     * @api GET|POST|DELETE /wp/v2/pages/<id>
     *
     * @param int $id
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function page(int $id)
    {
        $this->setWpUrl(self::ROUTE_PAGE, [ $id ]);

        return $this;
    }

    /**
     * @api GET|POST /wp/v2/media
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function medias()
    {
        $this->setWpUrl(self::ROUTE_MEDIAS);

        return $this;
    }

    /**
     * @api GET|POST|DELETE /wp/v2/media/<id>
     *
     * @param int $id
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function media(int $id)
    {
        $this->setWpUrl(self::ROUTE_MEDIA, [ $id ]);

        return $this;
    }

    /**
     * @api GET /wp/v2/types
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function types()
    {
        $this->setWpUrl(self::ROUTE_TYPES);

        return $this;
    }

    /**
     * @api GET /wp/v2/types/<id>
     *
     * @param int $id
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function type(int $id)
    {
        $this->setWpUrl(self::ROUTE_TYPE, [ $id ]);

        return $this;
    }

    /**
     * @api GET /wp/v2/statuses
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function statuses()
    {
        $this->setWpUrl(self::ROUTE_STATUSES);

        return $this;
    }

    /**
     * @api GET /wp/v2/statuses/<id>
     *
     * @param int $id
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function status(int $id)
    {
        $this->setWpUrl(self::ROUTE_STATUS, [ $id ]);

        return $this;
    }

    /**
     * @api GET|POST /wp/v2/comments
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function comments()
    {
        $this->setWpUrl(self::ROUTE_COMMENTS);

        return $this;
    }

    /**
     * @api GET|POST|DELETE /wp/v2/comments/<id>
     *
     * @param int $id
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function comment(int $id)
    {
        $this->setWpUrl(self::ROUTE_COMMENT, [ $id ]);

        return $this;
    }

    /**
     * @api GET /wp/v2/taxonomies
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function taxonomies()
    {
        $this->setWpUrl(self::ROUTE_TAXONOMIES);

        return $this;
    }

    /**
     * @api GET /wp/v2/taxonomies/<id>
     *
     * @param int $id
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function taxonomy(int $id)
    {
        $this->setWpUrl(self::ROUTE_TAXONOMY, [ $id ]);

        return $this;
    }

    /**
     * @api GET|POST /wp/v2/categories
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function categories()
    {
        $this->setWpUrl(self::ROUTE_CATEGORIES);

        return $this;
    }

    /**
     * @api GET|POST|DELETE /wp/v2/categories/<id>
     *
     * @param int $id
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function category(int $id)
    {
        $this->setWpUrl(self::ROUTE_CATEGORY, [ $id ]);

        return $this;
    }

    /**
     * @api GET|POST /wp/v2/tags
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function tags()
    {
        $this->setWpUrl(self::ROUTE_TAGS);

        return $this;
    }

    /**
     * @api GET|POST|DELETE /wp/v2/tags/<id>
     *
     * @param int $id
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function tag(int $id)
    {
        $this->setWpUrl(self::ROUTE_TAG, [ $id ]);

        return $this;
    }

    /**
     * @api GET|POST /wp/v2/users
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function users()
    {
        $this->setWpUrl(self::ROUTE_USERS);

        return $this;
    }

    /**
     * @api GET|POST|DELETE /wp/v2/users/<id>
     *
     * @param int $id
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function user(int $id)
    {
        $this->setWpUrl(self::ROUTE_USER, [ $id ]);

        return $this;
    }

    /**
     * @api GET|POST /wp/v2/users
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function me()
    {
        $this->setWpUrl(self::ROUTE_USER_ME);

        return $this;
    }

    /**
     * @api GET /acf/v2
     *
     * @return $this
     */
    public function acf()
    {
        $this->setAcfUrl(self::ROUTE_INDEX);

        return $this;
    }

    /**
     * @api GET /acf/v2/options
     *
     * @return $this
     */
    public function options()
    {
        $this->setAcfUrl(self::ROUTE_ACF_OPTIONS);

        return $this;
    }

    /* ----------------------------------------------------------------------------------- */

    /**
     * @return mixed
     *
     * @throws \Exception
     */
    public function get()
    {
        $this->validateOneRequest();

        return $this->request('GET', $this->url, [
            'query' => $this->params
        ]);
    }

    /**
     * @param array $data
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function save(array $data = [])
    {
        $this->validateOneRequest();

        return $this->request('POST', $this->url, [
            'query' => $this->params,
            'form_params' => $data
        ]);
    }

    /**
     * @return mixed
     *
     * @throws \Exception
     */
    public function delete()
    {
        $this->validateOneRequest();

        return $this->request('DELETE', $this->url, [
            'query' => $this->params
        ]);
    }

    /* ----------------------------------------------------------------------------------- */

    /**
     * @throws \Exception
     */
    protected function validateOneRequest()
    {
        if (empty($this->url)) {
            throw new \Exception('You need to set what you want to receive before make a request.');
        }
    }

    /**
     * @param string $url
     *
     * @return string
     *
     * @throws \Exception
     */
    protected function getBaseUrl($url)
    {
        if (! empty($this->url)) {
            throw new \Exception('You have already choose what you want to take from WordPress site.');
        }

        return self::ROUTE_BASE . $url;
    }

    /**
     * @param string $url
     * @param array $params
     */
    protected function setBaseUrl($url, array $params = [])
    {
        if (! empty($params)) {
            $url = sprintf($url, ...$params);
        }

        $this->url = $this->getBaseUrl($url);
    }

    /**
     * @param string $url
     * @param array $params
     */
    protected function setWpUrl($url, array $params = [])
    {
        if (! empty($params)) {
            $url = sprintf($url, ...$params);
        }

        $this->setBaseUrl(self::ROUTE_WP . $url);
    }

    /**
     * @param string $url
     * @param array $params
     */
    protected function setAcfUrl($url, array $params = [])
    {
        if (! empty($params)) {
            $url = sprintf($url, ...$params);
        }

        $this->setBaseUrl(self::ROUTE_ACF . $url);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     *
     * @return array|null
     */
    protected function request($method, $uri, array $options = [])
    {
        $response = $this->client->request($method, $uri, $options);

        return json_decode($response->getBody()->getContents(), true);
    }
}