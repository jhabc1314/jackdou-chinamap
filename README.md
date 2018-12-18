# jackdou-chinamap
laravel扩展 中国地图 webApi 集合

## 功能介绍

  地图是大家经常在应用中需要使用到的功能，包括用户定位，Ip地址转换，地理位置正/逆编码等等。
  国内目前有很多地图API提供接口使用，但是每个公司的接口都不一样，为了方便使用不同的地图API，故写了这个包。
  目前集合了国内比较大的主流地图，包括百度，高德，腾讯等，实现了一些常用的功能，并且功能还会不断的扩展，
  如果遇到使用的问题或bug可以提issues
  
## 安装说明

  - 使用composer安装
  
    > composer require jackdou/chinamap
    
    建议使用 [中国composer全量镜像](https://pkg.phpcomposer.com)
    
  - 配置
  
    在 config/app.php providers数组 内添加一行
    
    Jackdou\Chinamap\ChinamapServicesProvider::class
    
    执行命令生成配置文件
    
    > php artisan vendor:publish
    
    需要使用哪种地图接口，需要先去相应的地图网站申请成为应用开发者，具体操作请翻阅相关文档。
    
    [百度地图](http://lbsyun.baidu.com/index.php?title=webapi)
    [高德地图](http://lbs.amap.com/api/webservice/summary)
    [腾讯地图](http://lbs.qq.com/webservice_v1/index.html)
    
    注意：申请了应用对应的密钥后需要再配置文件config/chinamap.php中对应的添加上
    
  - 使用
  直接使用Map门面调用
  
    ```
    IP定位
    Map::locateIp($ip) //使用配置里的默认地图选择
    Map::type('amap')->locateIp($ip) //使用选择的地图，amap为高德 baidu为百度，qq为腾讯
    //注意：type方法如果调用则必须为第一个调用
    Map::outPut()->locateIp($ip); 
    //选择输出格式，默认为json，调用outPut后无需传参数，返回格式变成xml（部分地图接口不支持返回xml格式，详细请参见对应的api文档）
    ```
    ```
    地理位置编码/逆编码 （暂不支持批量查询）
    Map::address('上海市虹口区政府')
        ->city('上海市')
        ->geoCoder(); //地理位置编码，具体的地址参数的详细要求参见具体文档，qq地图暂不支持city方法
    Map::location('31.271,121.494')
        ->geoCoder(); //地理位置逆编码 百度和qq为纬度在前，经度在后，高德地图相反 
    ```
    ```
    坐标转换
    Map::geoConvert('114.21892734521,29.575429778924');
    ```
    ```
    路径规划
    Map::origin('40.056878,116.30815)->transit('40.056878,116.30815');
    Map::transitType('walking')->origin('40.056878,116.30815')->transit('40.056878,116.30815');
    ```

  - v1.3 最新版本功能暂时处于测试阶段
