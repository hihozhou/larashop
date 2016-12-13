/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

//Vue.component('example', require('./components/Example.vue'));
//
const Foo = {template: '<div>foo</div>'};
const Bar = {template: '<div>bar</div>'};

const routes = [
    {path: '/admin', component: Foo},
    {path: '/admin/index', component: Foo},
    {path: '/admin/bar', component: Bar}
];
//
const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router
}).$mount('#app');

//
//routers.map({
//    '/123': {
//        component: require('./components/Example.vue')
//    }
//});

