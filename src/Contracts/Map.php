<?php
namespace Jackdou\Chinamap\Contracts;

interface Map
{
    /**
     * 支持的地图Api列表
     * @var array
     */
    const MAPS = [
        'baidu' => 'baidu',
        'gaode' => 'amap',
        'tengxu' => 'qq',
    ];

    /**
     * IP定位
     * @param $ip
     * @return mixed
     */
    public function locateIp($ip);

    /**
     * 坐标转换
     * @param $coords
     * @return mixed
     */
    public function geoConvert($coords);

    /**
     * 地理位置正、逆编码
     * @return mixed
     */
    public function geoCoder();
}