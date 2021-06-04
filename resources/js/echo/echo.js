import VueEcho from "vue-echo-laravel";
import Vue from "vue";
import Pusher from "pusher-js";

Vue.use(VueEcho, {
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
});
