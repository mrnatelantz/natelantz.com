<?php



$factory->define(App\Modules\Pages\Page::class, function (Faker\Generator $faker) {

    $content = [
        'wysiwyg' => '<p>'.$faker->realText(200, 2).'</p>',
        'image' => $faker->imageUrl(640, 480, 'cats')
    ];

    return [
        'slug' => $faker->slug(),
        'name' => $faker->realText(100, 1),
        'cover_image' => $faker->imageUrl(640, 480, 'cats'),
        'content' => json_encode($content),
        'template' => 'home',
        'publish_date' => \Carbon\Carbon::now()->toDateTimeString(),
        'unpublish_date' => null,
        'published' => 0
    ];
});
