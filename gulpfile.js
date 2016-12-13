const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

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

elixir(mix => {
    mix.webpack('app.js')
        .version('js/app.js');// resources/assets/js/app.js to public/js/app.js

    //Admin css
    mix.sass('admin/app.scss', 'public/css/admin/app.css');
    //Admin js
    mix.scripts('admin/jquery-2.2.0.min.js', 'public/js/admin/jquery-2.2.0.min.js');
    mix.scripts('admin/pnotify.js', 'public/js/admin/pnotify.js');
    mix.scripts('admin/pnotify.buttons.js', 'public/js/admin/pnotify.buttons.js');
    mix.webpack('admin/app.js', 'public/js/admin/app.js');
});

