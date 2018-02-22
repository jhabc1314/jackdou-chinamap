<?php
namespace Jackdou\Chinamap\Maps;

use Ixudra\Curl\Facades\Curl;
use Jackdou\Chinamap\Contracts\Map;

class Amapmap implements Map
{
    /**
     * 地图别名
     * @var
     */
    public $alias;

    /**
     * 配置信息
     * @var \Illuminate\Config\Repository|mixed
     */
    public $config;

    /**
     * 输出格式 json or xml
     * @var string
     */
    public $outPut = 'json';

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

    /**
     * 设置输出数据格式
     * @param string $outPut
     * @return $this
     */
    public function outPut($outPut = 'xml')
    {
        $this->outPut = $outPut ?: $this->outPut;
        return $this;
    }
}