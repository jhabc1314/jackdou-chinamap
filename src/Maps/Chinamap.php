<?php
namespace Jackdou\Chinamap\Maps;

use Jackdou\Chinamap\Contracts\Map;

class Chinamap implements Map
{
    /**
     * web地图api 版本
     */
    const VERSION = '1.0';

    /**
     * 使用的地图类型
     * @var
     */
    public $mapType;

    public function __construct()
    {
        $this->setMapType(config('chinamap.default'));
        $this->initMap();
    }

    /**
     * 绑定所有地图服务到容器中
     */
    private function initMap()
    {
        foreach (self::MAPS as $item) {
            $className = 'Jackdou\Chinamap\Maps\\' . ucfirst($item) . 'Map';
            app()->singleton($item, $className);
        }
    }

    /**
     * 地图类型
     * @param string $mapType
     * @return $this
     */
    public function type($mapType)
    {
        $this->setMapType($mapType);
        return $this;
    }

    public function getMapType()
    {
        return $this->mapType;
    }

    public function setMapType($mapType = null)
    {
        $this->mapType = $mapType ?: $this->mapType;
    }

    private function getMap($param = [])
    {
        return app($this->mapType, $param);
    }

    public function locateIp($ip = null)
    {
        return $this->getMap()->locateIp($ip);
    }

    public function geoConvert($coords, $from = 1, $to = 5, $outPut = 'json')
    {
        return $this->getMap()->geoConvert();
    }

    public function geoCoder()
    {
        return $this->getMap()->geoCoder();
    }
}