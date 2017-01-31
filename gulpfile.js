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

    //home css
    mix.styles('home/common.css', 'public/css/home/common.css');
    mix.styles('home/swiper.css', 'public/css/home/swiper.css');
    mix.styles('home/index.css', 'public/css/home/index.css');

    mix.copy('node_modules/admin-lte/plugins/daterangepicker/daterangepicker.css', 'resources/assets/css/admin/daterangepicker.css');
    mix.styles('admin/daterangepicker.css', 'public/css/admin/daterangepicker.css');
    mix.copy('node_modules/bootstrap-sass/assets/fonts', 'public/css/fonts');

    mix.sass('home/app.scss', 'public/css/home/app.css');
    mix.styles('home/base.css', 'public/css/home/base.css');
    mix.styles('home/select.css', 'public/css/home/select.css');
    mix.styles('home/select_address.css', 'public/css/home/select_address.css');
    mix.styles('home/iosOverlay.css', 'public/css/home/iosOverlay.css');
    mix.styles('home/goods.css', 'public/css/home/goods.css');
    mix.styles('home/cart.css', 'public/css/home/cart.css');
    mix.styles('home/order_list.css', 'public/css/home/order_list.css');
    mix.styles('home/order_show.css', 'public/css/home/order_show.css');
    mix.styles('home/login.css', 'public/css/home/login.css');
    mix.styles('home/user.css', 'public/css/home/user.css');
    mix.scripts('home/swiper.jquery.min.js', 'public/js/home/swiper.jquery.min.js');
    mix.scripts('home/fastclick.js', 'public/js/home/fastclick.js');
    mix.scripts('home/spin.min.js', 'public/js/home/spin.min.js');
    mix.scripts('home/iosOverlay.js', 'public/js/home/iosOverlay.js');
    mix.scripts('home/goods.js', 'public/js/home/goods.js');
    mix.scripts('home/cart.js', 'public/js/home/cart.js');
    mix.scripts('home/myc.js', 'public/js/home/myc.js');
    mix.scripts('home/area.js', 'public/js/home/area.js');
    mix.scripts('home/select_address.js', 'public/js/home/select_address.js');
    mix.copy('resources/assets/images/home', 'public/images/home');

});

