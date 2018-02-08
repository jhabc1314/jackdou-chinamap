<?php
namespace Jackdou\Chinamap\Facade;

use Illuminate\Support\Facades\Facade;

class Map extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'map';
    }
}