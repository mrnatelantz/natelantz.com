var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 | Commands:
 | $ gulp  (runs tasks)
 | $ gulp --production   (runs tasks, minifies, registers with elixir) use this one
 |
 */

elixir(function(mix) {

    mix.copy('./node_modules/trumbowyg/dist', 'public/assets/vendor/trumbowyg');
    mix.copy('./node_modules/material-design-lite/dist/templates/dashboard/images', './public/assets/vendor/mdl-admin/images');


    mix.styles([
        './node_modules/material-design-lite/dist/material.indigo-pink.min.css',
        './node_modules/material-design-lite/dist/templates/dashboard/styles.css'
    ], 'public/assets/vendor/mdl-admin/custom.css')

    .scripts([
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/material-design-lite/dist/material.min.js'
    ], 'public/assets/js/admin.js')

    .scripts([
        './system/Pages/Resources/js/pages-form.js'
    ], 'public/assets/js/pages/pages-form.js')

    .version([
        'public/assets/vendor/mdl-admin/custom.css',
        'public/assets/js/admin.js',
        'public/assets/js/pages/pages-form.js'
    ]);



});

