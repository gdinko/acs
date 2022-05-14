<?php

namespace Gdinko\Acs\Facades;

use Illuminate\Support\Facades\Facade;

class Acs extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'acs';
    }
}
