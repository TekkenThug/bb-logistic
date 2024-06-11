import { createApp } from "vue";
import { createPinia } from "pinia";

import router from "@/router";

import UILoader from "@/components/UI/loader/UILoader";

import App from "./App.vue";

const pinia = createPinia()

createApp(App)
.use(router)
.use(pinia)
.component('UILoader', UILoader)
.mount("#app");
