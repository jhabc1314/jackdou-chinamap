<?php
return [
    /*
     * 默认采用的地图api
     */
    'default' => 'baidu',

    /*
     * 百度地图api应用开发者数据
     * ak 为开发者密钥，可在百度地图api控制台申请获得
     * sn 若用户所用AK的校验方式为SN校验时该参数必填。其他AK校验方式的可不填写。目前暂不支持此方式
     */
    'baidu' => [
        'ak' => '',
        'sn' => '',

        /*
         * 普通IP定位API 具体功能请参见百度文档 http://lbsyun.baidu.com/index.php?title=webapi/ip-api
         * type 可选项有http和https
         */
        'location.ip' => [
            'type' => 'http',
            'url' => 'api.map.baidu.com/location/ip'
        ],

        /*
         * 坐标转换服务 具体功能请参见百度文档 http://lbsyun.baidu.com/index.php?title=webapi/guide/changeposition
         */
        'geoconv.v1' => 'http://api.map.baidu.com/geoconv/v1/',

        /*
         * 正/逆地理编码服务 具体功能请参见百度文档 http://lbsyun.baidu.com/index.php?title=webapi/guide/webservice-geocoding
         */
        'geocoder.v2' => 'http://api.map.baidu.com/geocoder/v2/',

        /*
         * 路线规划服务 具体功能参见百度文档 http://lbsyun.baidu.com/index.php?title=webapi/direction-api-v2
         */
        'transit.v2' => 'http://api.map.baidu.com/direction/v2/transit',


    ],

    /*
     * 高德地图api应用开发者账号
     */
    'amap' => [

        'key' => '',

        /*
         * IP定位服务 具体文档 http://lbs.amap.com/api/webservice/guide/api/ipconfig
         */
        'location.ip' => 'http://restapi.amap.com/v3/ip',

        /*
         * 地理位置编码
         */
        'geo' => 'http://restapi.amap.com/v3/geocode/geo',

        /*
         * 地理位置逆编码 https://lbs.amap.com/api/webservice/guide/api/georegeo
         */
        'regeo' => 'http://restapi.amap.com/v3/geocode/regeo',

        /*
         * 坐标转换 https://lbs.amap.com/api/webservice/guide/api/convert
         */
        'convert' => 'https://restapi.amap.com/v3/assistant/coordinate/convert?',

        /*
         * 路径规划 https://lbs.amap.com/api/webservice/guide/api/direction#walk
         */
        'transit' => [
            //步行
            'walking' => 'https://restapi.amap.com/v3/direction/walking?',

            //公交
            'integrated' => 'https://restapi.amap.com/v3/direction/transit/integrated?',

            //驾车
            'driving' => 'https://restapi.amap.com/v3/direction/driving?',

            //骑行
            'bicycling' => 'https://restapi.amap.com/v4/direction/bicycling?'
        ]

    ],

    /*
     * 腾讯地图api应用开发者账号
     */
    'qq' => [
        /*
         * 应用者申请密钥
         */
        'key' => '',

        /*
         * Ip定位服务 具体服务文档参见 http://lbs.qq.com/webservice_v1/guide-ip.html
         */
        'location.ip' => 'https://apis.map.qq.com/ws/location/v1/ip',

        /*
         * 地理位置编码/逆编码 https://lbs.qq.com/webservice_v1/guide-gcoder.html
         * https://lbs.qq.com/webservice_v1/guide-geocoder.html
         */
        'geoCoder' => 'https://apis.map.qq.com/ws/geocoder/v1/',

        /*
         * 坐标转换 https://lbs.qq.com/webservice_v1/guide-convert.html
         */
        'translate' => 'https://apis.map.qq.com/ws/coord/v1/translate?',

        /*
         * 路径规划服务 https://lbs.qq.com/webservice_v1/guide-road.html
         */
        'transit' => [
            //驾车
            'driving' => 'https://apis.map.qq.com/ws/direction/v1/driving/?',

            //步行
            'walking' => 'https://apis.map.qq.com/ws/direction/v1/walking/?',

            //骑行
            'bicycling' => 'https://apis.map.qq.com/ws/direction/v1/bicycling/?',

            //公交
            'integrated' => 'https://apis.map.qq.com/ws/direction/v1/transit/?',
        ]

    ],

    /*
     * 支持的地图Api列表
     * @var array
     */
    'maps' => [
        'baidu' => 'baidu',
        'amap' => 'amap',
        'qq' => 'qq',
    ],
];