import Vue from "vue";
import VueRouter from 'vue-router';

import router from "@/router";
import store from "@/store";

import UIPreloader from "@/components/UI/preloader";

Vue.use(VueRouter);

Vue.component('UIPreloader', UIPreloader);

const app = new Vue({
    el: '#app',
    router,
    store,
});