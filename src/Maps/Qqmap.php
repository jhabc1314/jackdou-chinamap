<?php
namespace Jackdou\Chinamap\Maps;

use Ixudra\Curl\Facades\Curl;
use Jackdou\Chinamap\Contracts\Map;

class Qqmap implements Map
{
    /**
     * 地图别名
     * @var
     */
    public $alias;

    /**
     * 配置信息
     * @var
     */
    public $config;

    /**
     * 输出格式 json or xml
     * @var
     */
    public $outPut = 'json';

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

    public function outPut($outPut = 'xml')
    {
        $this->outPut = $outPut ?: $this->outPut;
        return $this;
    }
}