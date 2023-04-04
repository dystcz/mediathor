<?php

namespace Dystcz\Mediathor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Dystcz\Mediathor\Skeleton\SkeletonClass
 */
class MediaThor extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mediathor';
    }
}
