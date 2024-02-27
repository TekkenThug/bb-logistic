import { createApp } from "vue";

import router from "@/router";
import store from "@/store";

import UIPreloader from "@/components/UI/preloader";

import App from "./App.vue";

createApp(App)
.use(router)
.use(store)
.component('UIPreloader', UIPreloader)
.mount("#app");