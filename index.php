<?php

use Kirby\Cms\App as Kirby;

class Maintenance {

    private $kirby;

    public function __construct( $kirby = null )
    {
        $this->kirby = $kirby ?? kirby();
    }

    public function isOn(){
        if( $this->kirby->option('maintenance', false)){
            return true;
        }
        if( $this->kirby->site()->maintenance()->isTrue() ){
            return true;
        }
        return false;
    }

    public function isOff(){
        return !$this->isOn();
    }

    public function shouldPathBeIgnored( $path ){
        
        $urls = $this->kirby->urls()->toArray();

        $ignore = array_merge( $this->kirby->option('moritzebeling.kirby-maintenance.ignore', []),[
            'assets',
            'api',
            'media',
            'panel',
        ]);

        foreach ($ignore as $i) {
            if( in_array($i,$urls) ){
                // map ignored paths to kirby ingredient urls
                $i = $urls[$i];
            }
            if( str_starts_with( $path, $i ) ){
                // path is ignored or reserved by kirby
                return true;
            }
        }

        return false;
    }

    public function showPageToLoggedinUser(){
        return $this->kirby->user() ? true : false;
    }

    public function setHeaders(){
        $protocol = $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1' ? 'HTTP/1.1' : 'HTTP/1.0';
        header( $protocol . ' 503 Service Unavailable', true, 503 );
    }

    public function message(){
        if( $this->kirby->site()->maintenance_text()->isNotEmpty() ){
            echo $this->kirby->site()->maintenance_text();
            return;
        }
        return option('moritzebeling.kirby-maintenance.text');
    }

}

Kirby::plugin('moritzebeling/kirby-maintenance', [

    'options' => [
        'ignore' => [],
        'text' => 'This website is currently under maintenance and will be back online soon.'
    ],

    'blueprints' => [
        'fields/maintenance' => __DIR__ . '/blueprints/field.yml',
        'fields/maintenance_text' => __DIR__ . '/blueprints/text.yml',
        'sections/maintenance' => __DIR__ . '/blueprints/section.yml',
        'tabs/maintenance' => __DIR__ . '/blueprints/tab.yml',
    ],

    'hooks' => [
        'route:before' => function ($route, $path, $method) {

            $maintenance = new Maintenance();

            if( $maintenance->isOff() ){
                return;
            }
            
            if( $maintenance->shouldPathBeIgnored( $path ) ){
                return;
            }
            
            if( $maintenance->showPageToLoggedinUser() ){
                return;
            }

            $maintenance->setHeaders();
            $maintenance->message();
            
            exit;
        }
    ]

]);