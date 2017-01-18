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
    mix.copy('resources/assets/js/admin/um', 'public/js/admin/um/');
    mix.scripts('admin/goods/base.js', 'public/js/admin/goods/base.js');
    mix.scripts('admin/goods/upload_img.js', 'public/js/admin/goods/upload_img.js');
    mix.scripts('admin/goods/goods_msg.js', 'public/js/admin/goods/goods_msg.js');
    mix.scripts('admin/goods/upload_base.js', 'public/js/admin/goods/upload_base.js');
    mix.scripts('admin/goods/jquery.fileupload.js', 'public/js/admin/goods/jquery.fileupload.js');
    mix.scripts('admin/goods/jquery.ui.widget.js', 'public/js/admin/goods/jquery.ui.widget.js');
    mix.copy('resources/assets/images/admin', 'public/images/admin/');

    //Shop css
    mix.styles('shop/common.css', 'public/css/shop/common.css');
    mix.styles('shop/swiper.css', 'public/css/shop/swiper.css');
    mix.styles('shop/index.css', 'public/css/shop/index.css');

    mix.copy('node_modules/admin-lte/plugins/daterangepicker/daterangepicker.css', 'resources/assets/css/admin/daterangepicker.css');
    mix.styles('admin/daterangepicker.css', 'public/css/admin/daterangepicker.css');
    mix.copy('node_modules/bootstrap-sass/assets/fonts', 'public/css/fonts');

});

