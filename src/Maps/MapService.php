<?php
namespace Jackdou\Chinamap\Maps;

use Jackdou\Chinamap\Exceptions\ChinamapException;

class MapService
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

    public function __call($function, $args)
    {
        throw new ChinamapException("sorry, $this->alias map is not support function '$function'");
    }
}