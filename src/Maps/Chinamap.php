<?php
namespace Jackdou\Chinamap\Maps;

class Chinamap
{
    /**
     * web地图api 版本
     */
    const VERSION = '0.1';

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
        foreach (config('chinamap.maps') as $item) {
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

    /**
     * 调用对应api的接口时引导到相应的实例服务
     * @param $function
     * @param $args
     * @return mixed
     */
    public function __call($function, $args)
    {
        if ($args) {
            return $this->getMap()->$function($args[0]);
        }
        return $this->getMap()->$function();
    }
}