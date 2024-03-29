/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


Vue.component('v-footer', require('./components/Footer.vue').default);
Vue.component('preloader', require('./components/Preloader.vue').default);
Vue.component('message', require('./components/ModalWindow.vue').default);
Vue.component('popup', require('./components/Popup.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import router from "./router";
import auth from "./auth/index";

router.beforeEach((to, from, next) => {
    document.title = to.meta.title || 'B&B Logistic';
    next();
});

/**
 * Плагины
 */
import ApiPlugin from "./plugins/api";
import LoadPlugin from "./plugins/load"

Vue.use(ApiPlugin);
Vue.use(LoadPlugin);

const app = new Vue({
    el: '#app',
    router,
    auth,
});
