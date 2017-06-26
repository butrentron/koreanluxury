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
 */

elixir(function(mix) {
    mix.sass('app.scss');
    mix.styles([
        'menu/menu.css',
        'slide/styles.css',
        'main.css'
    ], 'public/css/app.css');

    mix.scripts([
        'slide/jquery.flexslider-min.js'
    ], 'public/js/slide.js');

    mix.scripts([
        'menu/main.js'
    ], 'public/js/main.js');

    mix.scripts([
        'image/zoom.js'
    ], 'public/js/zoom-image.js');

    mix.scripts([
        'menu/modernizr.js'
    ], 'public/js/modernizr.js');


    mix.version([
        'css/app.css',
        'js/main.js',
        'js/modernizr.js',
        'js/slide.js',
        'js/zoom-image.js'
    ]);
});
