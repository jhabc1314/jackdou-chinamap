<?php
namespace Jackdou\Chinamap;

use Illuminate\Support\ServiceProvider;
use Jackdou\Chinamap\Maps\Chinamap;

class ChinamapServicesProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('chinamap.php'),
        ]);
    }

    public function register()
    {
        //合并用户自定义配置和默认配置
        $this->mergeConfigFrom(
            __DIR__.'/config/config.php', 'chinamap'
        );

        //注册地图api服务
        $this->app->bind('map', function () {
            return new Chinamap();
        });
    }
    
}