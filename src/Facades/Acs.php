<?php

namespace Gdinko\Acs\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array ACS_Trackingsummary(array $arguments)
 * @method static array ACS_TrackingDetails(array $arguments)
 * @method static array ACS_Get_Content_Types(array $arguments)
 *
 * @see \Gdinko\Acs\Acs
 */
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
