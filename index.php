<?php

use Kirby\Cms\App as Kirby;
use Kirby\Toolkit\F;

class Maintenance {

    private $kirby;

    public function __construct( $kirby = null )
    {
        $this->kirby = $kirby ?? kirby();
    }

    public function isOn(){
        if( $this->kirby->option('maintenance', false) ){
            return true;
        }
        if( F::exists($this->kirby->roots()->index() . '/.maintenance') ){
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

    public function supportMultiLang(){
        if($this->kirby->languages()) {
            // Sniff the language code from the URL
            $explodedPath = explode('/', $this->kirby->path());
            $langCode = null;
            if (isset($explodedPath[0])) {
                $langCode = $explodedPath[0];
            }

            // Try find match in the languages config
            if(
                (isset($langCode)) &&
                (in_array($langCode, array_keys($this->kirby->languages()->toArray())))
            ) {
                // Switch Kirby into the current language mode
                $this->kirby->site()->visit('home', $langCode);
            }
        }
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

            return $this->kirby->site()->maintenance_text();

        } if( F::exists($this->kirby->roots()->index() . '/.maintenance')
            && $content = F::read($this->kirby->roots()->index() . '/.maintenance') ){

            return $content;

        }
        return option('moritzebeling.kirby-maintenance.text');
    }

    public function render( $message ){
        echo '<html><head>';

            echo '<title>'. $this->kirby->site()->title() .': 503 service currently unavailable</title>';

            if( $css = $this->kirby->option('moritzebeling.kirby-maintenance.css') ){
                echo css( $css );
            }

        echo '</head><body>';

            echo '<div class="message">';
                echo $message;
            echo '</div>';

        echo '</body></html>';
    }

}

Kirby::plugin('moritzebeling/kirby-maintenance', [

    'options' => [
        'ignore' => [],
        'css' => false,
        'text' => 'This website is currently under maintenance and will be back online soon.'
    ],

    'blueprints' => [
        'fields/maintenance' => __DIR__ . '/blueprints/field.yml',
        'fields/maintenance/text' => __DIR__ . '/blueprints/text.yml',
        'sections/maintenance' => __DIR__ . '/blueprints/section.yml',
        'tabs/maintenance' => __DIR__ . '/blueprints/tab.yml',
    ],

    'hooks' => [
        'route:before' => function ($route, $path, $method) {

            $maintenance = new Maintenance();

            if( $maintenance->shouldPathBeIgnored( $path ) ){
                return;
            }

            $maintenance->supportMultiLang();

            if( $maintenance->isOff() ){
                return;
            }

            if( $maintenance->showPageToLoggedinUser() ){
                return;
            }

            $maintenance->setHeaders();
            echo $maintenance->render(
                $maintenance->message()
            );

            exit;
        }
    ]

]);
