<?php
namespace Jackdou\Chinamap\Maps;

use Ixudra\Curl\Facades\Curl;
use Jackdou\Chinamap\Contracts\Map;
use Jackdou\Chinamap\Exceptions\ChinamapException;

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
        $param  = "?ip={$ip}&outPut={$this->outPut}" . $this->appendParam();
        $url = $domain . $param;
        return Curl::to($url)
            ->get();
    }

    public function geoConvert($p)
    {

    }

    /**
     * 地理位置编码/逆编码
     */
    public function geoCoder()
    {
        $domain = $this->config['geoCoder'];
        if (!empty($this->address)) {
            $param = "?address={$this->address}";
        } elseif (!empty($this->location)) {
            $param = "?location={$this->location}";
        } else {
            throw new ChinamapException('sorry,geoCoder function need “address” or “location” is not empty');
        }
        $param .= "&outPut={$this->outPut}" . $this->appendParam();
        $url = $domain . $param;
        return Curl::to($url)
            ->get();
    }

    public function appendParam()
    {
        return "&key=" . $this->config['key'];
    }
}