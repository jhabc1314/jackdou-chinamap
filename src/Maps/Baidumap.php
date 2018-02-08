<?php
namespace Jackdou\Chinamap\Maps;


use Ixudra\Curl\Facades\Curl;
use Jackdou\Chinamap\Contracts\Map;

class BaiduMap extends MapService implements Map
{
    public $alias;
    public $config;

    public function __construct()
    {
        $this->alias = self::MAPS['baidu'];
        $this->config = config('chinamap.' . $this->alias);
    }

    public function locateIp($ip)
    {
        $url = $this->config['location.ip']['type'] . '://' . $this->config['location.ip']['url'] . "?ip=$ip&ak=" . $this->config['ak'];
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
}