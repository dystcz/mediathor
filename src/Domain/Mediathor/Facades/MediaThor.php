<?php

declare(strict_types=1);

namespace Dystcz\MediaThor\Domain\MediaThor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Dystcz\MediaThor\Skeleton\SkeletonClass
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
