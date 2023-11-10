<?php

namespace Libaro\SecureId;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Libaro\SecureId\Skeleton\SkeletonClass
 */
class SecureIdFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'secure-id';
    }
}
