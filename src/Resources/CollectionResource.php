<?php

namespace NunoCodex\WpApi\Resources;

use NunoCodex\WpApi\Traits\FiltersTrait;

/**
 * Class CollectionResource
 *
 * @package NunoCodex\WpApi\Resources
 */
abstract class CollectionResource extends AbstractResource
{
    use FiltersTrait;
}