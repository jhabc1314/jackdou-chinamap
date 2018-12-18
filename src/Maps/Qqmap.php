<?php
namespace Jackdou\Chinamap\Maps;

use Ixudra\Curl\Facades\Curl;
use Jackdou\Chinamap\Contracts\Map;
use Jackdou\Chinamap\Exceptions\ChinamapException;

class Qqmap extends MapService implements Map
{

    /**
     * Qqmap constructor.
     */
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
        $param  = "?ip={$ip}&outPut={$this->outPut}" . $this->appendParam();
        $url = $domain . $param;
        return Curl::to($url)
            ->get();
    }

    /**
     * 坐标转换
     * @param string $locations
     * @throws ChinamapException
     * @return mixed
     */
    public function geoConvert($locations)
    {
        if (empty($locations)) {
            throw new ChinamapException('sorry,locations can not empty');
        }
        $domain = $this->config['translate'];
        $param = [
            'locations' => $locations,
            'output' => $this->outPut,
        ];
        $url = $domain . http_build_query($param) . $this->appendParam();
        return Curl::to($url)
            ->get();
    }

    /**
     * 地理位置编码/逆编码
     */
    public function geoCoder()
    {
        $domain = $this->config['geoCoder'];
        if (!empty($this->address)) {
            $param = "?address={$this->address}";
        } elseif (!empty($this->location)) {
            $param = "?location={$this->location}";
        } else {
            throw new ChinamapException('sorry,geoCoder function need “address” or “location” must not empty');
        }
        $param .= "&outPut={$this->outPut}" . $this->appendParam();
        $url = $domain . $param;
        return Curl::to($url)
            ->get();
    }

    /**
     * 路径规划
     * @param string $destination
     * @throws ChinamapException
     * @return mixed
     */
    public function transit($destination)
    {
        if (empty($this->transitType)) {
            throw new ChinamapException('sorry,transitType can not empty');
        }
        $domain = $this->config['transit'][$this->transitType];
        $param = [
            'from' => $this->origin,
            'to' => $destination,
            'output' => $this->outPut,
        ];
        $url = $domain . http_build_query($param) . $this->appendParam();
        return Curl::to($url)
            ->get();
    }

    public function appendParam()
    {
        return "&key=" . $this->config['key'];
    }
}