<?php

namespace Libaro\SecureId;

use Illuminate\Support\Facades\Facade;

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
