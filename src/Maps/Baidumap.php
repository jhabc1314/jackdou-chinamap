<?php
namespace Jackdou\Chinamap\Maps;


use Ixudra\Curl\Facades\Curl;
use Jackdou\Chinamap\Contracts\Map;

class BaiduMap extends MapService implements Map
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
     * @var
     */
    public $outPut = 'json';

    public function __construct()
    {
        $this->alias = config('chinamap.maps')['baidu'];
        $this->config = config('chinamap.' . $this->alias);
    }

    /**
     * IP定位Api
     * @param $ip
     * @return mixed
     */
    public function locateIp($ip = '')
    {
        $domain = $this->config['location.ip']['type'] . '://' . $this->config['location.ip']['url'];
        $param = "?ip=$ip&ak=" . $this->config['ak'];
        $url = $domain . $param;
        return Curl::to($url)
            ->get();
    }

    public function geoConvert($coords, ...$param)
    {
        $default = [
            'from' => 1,
            'to' => 5
        ];
        $url = $this->config['geoconv.v1'] . "?coords=$coords&from=$from&to=$to&ak=" . $this->config['ak'];
        return Curl::to($url)
            ->get();
    }

    public function geoCoder(...$param)
    {
        $url = $this->config['geoconv.v1'] . "?coords=$coords&from=$from&to=$to&ak=" . $this->config['ak'];
    }

    /**
     * 输出格式方法，默认为json，不需要调用此方法，如想xml格式，调用此方法即可
     * @param string $outPut
     * @return $this
     */
    public function outPut($outPut = 'xml')
    {
        $this->outPut = $outPut ?: $this->outPut;
        return $this;
    }
}