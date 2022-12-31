<?php

use Kirby\Cms\App as Kirby;

Kirby::plugin('moritzebeling/kirby-maintenance', [

    'options' => [
        'ignore' => [],
        'text' => 'This website is currently under maintenance and will be back online soon.'
    ],

    'hooks' => [
        'route:before' => function ($route, $path, $method) {

            if( !option('maintenance', false) ){
                // maintenance mode is off
                return;
            }

            $kirby = kirby();

            $urls = $kirby->urls()->toArray();
            $ignore = array_merge(option('moritzebeling.kirby-maintenance.ignore', []),[
                'maintenance',
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
                    return;
                }
            }

            if( $kirby->user() ){
                // user is logged in
                return;
            }
            
            /* @todo
            - check if there is a page with the slug "maintenance", if yes, display the page
            - allow toggling of maintenance mode via panel system option
            - allow pages to be ignored via field
            */

            echo option('moritzebeling.kirby-maintenance.text');
            exit;
        }
    ]

]);