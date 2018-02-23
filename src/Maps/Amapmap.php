<?php
namespace Jackdou\Chinamap\Maps;

use Ixudra\Curl\Facades\Curl;
use Jackdou\Chinamap\Contracts\Map;

class Amapmap extends MapService implements Map
{
    /**
     * Amapmap constructor.
     */
    public function __construct()
    {
        $this->alias = config('chinamap.maps')['amap'];
        $this->config = config('chinamap.' . $this->alias);
    }

    /**
     * IP定位API
     * @param $ip
     * @return mixed
     */
    public function locateIp($ip = '')
    {
        $domain = $this->config['location.ip'];
        $param = "?ip=$ip&output=$this->outPut&key=" . $this->config['key'];
        $url = $domain . $param;
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