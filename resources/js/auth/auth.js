import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";

import auth from "@websanova/vue-auth/dist/v2/vue-auth.js";
import router from "../router";

import driverAuthBearer      from '@websanova/vue-auth/dist/drivers/auth/bearer.esm.js';
import driverHttpAxios       from '@websanova/vue-auth/dist/drivers/http/axios.1.x.esm.js';
import driverRouterVueRouter from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js';

axios.defaults.baseURL = 'http://bb-logistic.test/api';

Vue.use(VueAxios, axios);

Vue.use(auth, {
    plugins: {
        http: Vue.axios,
        router
    },
    drivers: {
        auth: driverAuthBearer,
        http: driverHttpAxios,
        router: driverRouterVueRouter,
    },
    options: {
        rolesKey: 'role_id'
    }
});
