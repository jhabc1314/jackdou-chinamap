<?php
namespace Jackdou\Chinamap\Maps;

use Ixudra\Curl\Facades\Curl;
use Jackdou\Chinamap\Contracts\Map;

class Amapmap implements Map
{
    public $alias;
    public $config;

    public function __construct()
    {
        $this->alias = self::MAPS['gaode'];
        $this->config = config('chinamap.' . $this->alias);
    }

    public function locateIp($ip)
    {
        $url = $this->config['location.ip'] . "?ip=$ip&output=json&key=" . $this->config['key'];
        return Curl::to($url)
            ->get();
    }

    public function geoConvert($coords)
    {

    }

    public function geoCoder()
    {

    }
}