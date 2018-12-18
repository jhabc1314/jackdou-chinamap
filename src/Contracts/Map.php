<?php
namespace Jackdou\Chinamap\Contracts;

interface Map
{

    /**
     * IP定位
     * @param $ip
     * @return mixed
     */
    public function locateIp($ip);

    /**
     * 坐标转换
     * @param $coords string 坐标
     * @return mixed
     */
    public function geoConvert($coords);

    /**
     * 地理位置正、逆编码
     * @return mixed
     */
    public function geoCoder();

    /**
     * 路线规划
     * @param string $destination
     * @return mixed
     */
    public function transit($destination);

    /**
     * 追加固定参数
     * @return mixed
     */
    public function appendParam();

}