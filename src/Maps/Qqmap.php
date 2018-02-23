<?php
namespace Jackdou\Chinamap\Maps;

use Ixudra\Curl\Facades\Curl;
use Jackdou\Chinamap\Contracts\Map;

class Qqmap extends MapService implements Map
{

    /**
     * Qqmap constructor.
     */
    public function __construct()
    {
        $this->alias = config('chinamap.maps')['qq'];
        $this->config = config('chinamap.' . $this->alias);
    }

    /**
     * IP定位
     * @param $ip
     * @return mixed
     */
    public function locateIp($ip = '')
    {
        $domain = $this->config['location.ip'];
        $param  = "?ip=$ip&outPut=$this->outPut&key=" . $this->config['key'];
        $url = $domain . $param;
        return Curl::to($url)
            ->get();
    }

    public function geoConvert($p)
    {

    }

    public function geoCoder()
    {

    }


}