<?php
namespace Jackdou\Chinamap\Maps;


use Ixudra\Curl\Facades\Curl;
use Jackdou\Chinamap\Contracts\Map;
use Jackdou\Chinamap\Exceptions\ChinamapException;

class BaiduMap extends MapService implements Map
{


    /**
     * BaiduMap constructor.
     */
    public function __construct()
    {
        $this->alias = config('chinamap.maps')['baidu'];
        $this->config = config('chinamap.' . $this->alias);
    }

    /**
     * IP定位Api
     * @param $ip string
     * @throws ChinamapException
     * @return mixed
     */
    public function locateIp($ip)
    {
        if (empty($ip)) {
            throw new ChinamapException('sorry,Ip can not empty');
        }
        $domain = $this->config['location.ip']['type'] . '://' . $this->config['location.ip']['url'];
        $param = "?ip=$ip&output={$this->outPut}" . $this->appendParam();
        $url = $domain . $param;
        return Curl::to($url)
            ->get();
    }

    /**
     * 坐标转换服务
     * @param $coords string 坐标，多组坐标以;分隔
     * @return mixed
     */
    public function geoConvert($coords)
    {
        $url = $this->config['geoconv.v1'] . "?coords=$coords&ak=" . $this->config['ak'];
        return Curl::to($url)
            ->get();
    }

    /**
     * 地理位置编码/逆编码
     * 调用此方法前需要设置address变量（编码） 或location变量（逆编码） 否则抛出异常
     * @return mixed
     * @throws ChinamapException
     */
    public function geoCoder()
    {
        $domain = $this->config['geocoder.v2'];
        if (!empty($this->address)) {
            $param = "?address={$this->address}&city={$this->city}";
        } elseif (!empty($this->location)) {
            $param = "?location={$this->location}";
        } else {
            throw new ChinamapException('sorry,geoCoder function need “address” or “location” must not empty');
        }
        $param .= "&output={$this->outPut}" . $this->appendParam();
        $url = $domain . $param;
        return Curl::to($url)
            ->get();
    }


    /**
     * @param $destination string 目的地坐标 格式 维度，经度 小数点后不能超过6位
     * @throws ChinamapException
     * @return mixed
     */
    public function transit($destination)
    {
        if (empty($this->origin)) {
            throw new ChinamapException('sorry,transit need call origin func first');
        }
        if (empty($destination)) {
            throw new ChinamapException('sorry, destination can not empty');
        }
        $domain = $this->config['transit'];
        $param = "origin={$this->origin}&destination={$destination}&output={$this->outPut}";
        $param .= $this->appendParam();
        return Curl::to($domain . $param)
            ->get();
    }

    /**
     * 返回固定的拼接参数
     * @return string
     */
    public function appendParam()
    {
        return "&ak={$this->config['ak']}";
    }

}