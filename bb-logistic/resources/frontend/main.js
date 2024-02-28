import { createApp } from "vue";

import router from "@/router";
import store from "@/store";

import UILoader from "@/components/UI/loader/UILoader";

import App from "./App.vue";

createApp(App)
.use(router)
.use(store)
.component('UILoader', UILoader)
.mount("#app");