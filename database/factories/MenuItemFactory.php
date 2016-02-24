<?php

$factory->define(RadCms\Menu\Models\MenuItem::class, function (Faker\Generator $faker) {

    return [
        //0 => [
            'menu_id'   => 1,
            'type'      => 'external',
            'page_id'   => null,
            'name'      => 'Google',
            'url'       => '//google.com',
            'target'    => '_blank'
       // ]

    ];

});
