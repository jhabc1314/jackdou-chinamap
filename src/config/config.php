<?php
return [
    /*
     * 默认采用的地图api
     */
    'default' => 'baidu',

    /*
     * 百度地图api应用开发者数据
     * ak 为开发者密钥，可在百度地图api控制台申请获得
     * sn 若用户所用AK的校验方式为SN校验时该参数必填。其他AK校验方式的可不填写。
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
        'geocoder.v2' => 'http://api.map.baidu.com/geocoder/v2/'

    ],

    /*
     * 高德地图api应用开发者账号
     */
    'amap' => [

        'key' => '',

        /*
         * IP定位服务 具体文档 http://lbs.amap.com/api/webservice/guide/api/ipconfig
         */
        'location.ip' => 'http://restapi.amap.com/v3/ip?parameters',


    ],

    /*
     * 腾讯地图api应用开发者账号
     */
    'qq' => [
        ''
    ]
];