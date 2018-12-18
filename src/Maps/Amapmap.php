<?php
namespace Jackdou\Chinamap\Maps;

use Ixudra\Curl\Facades\Curl;
use Jackdou\Chinamap\Contracts\Map;
use Jackdou\Chinamap\Exceptions\ChinamapException;

class AmapMap extends MapService implements Map
{

    /**
     * Amapmap constructor.
     */
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
        $param = "?ip={$ip}&output={$this->outPut}" . $this->appendParam();
        $url = $domain . $param;
        return Curl::to($url)
            ->get();
    }

    /**
     * 坐标转换服务
     * @param string $coords 格式 经度，纬度
     * @throws ChinamapException
     * @return mixed
     */
    public function geoConvert($coords)
    {
        if (empty($coords)) {
            throw new ChinamapException('sorry,locations cant not empty');
        }
        $domain = $this->config['convert'];
        $param = [
            'locations' => $coords,
            'output' => $this->outPut
        ];
        $param = http_build_query($param) . $this->appendParam();
        return Curl::to($domain . $param)
            ->get();
    }

    /**
     * 地理位置编码/逆编码
     * @return mixed
     * @throws ChinamapException
     */
    public function geoCoder()
    {
        if (!empty($this->address)) {
            $domain = $this->config['geo'];
            $param = "?address={$this->address}&outPut={$this->outPut}";
        } elseif (!empty($this->location)) {
            $domain = $this->config['regeo'];
            $param = "?location={$this->location}&outPut={$this->outPut}";
        } else {
            throw new ChinamapException('sorry,geoCoder function need “address” or “location” is not empty');
        }
        $url = $domain . $param . $this->appendParam();
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
            'origin' => $this->origin,
            'destination' => $destination,
            'output' => $this->outPut,
        ];
        $url = $domain . http_build_query($param) . $this->appendParam();
        return Curl::to($url)
            ->get();
    }

    public function appendParam()
    {
        return "&key={$this->config['key']}";
    }

}
