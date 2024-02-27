import { createRouter, createWebHistory } from 'vue-router';

import Auth from "@/views/auth";

import errorRoutes from './errors';
import adminRoutes from './admin';
import courierRouters from './courier';
import clientRoutes from './client';

const postfix = (str) => `${str} - B&B Logistic`;

const routes = [
    {
      path: "/",
      redirect: { name: "login" },
    },
    {
      path: "/login",
      component: Auth,
      name: 'login',
      meta: {
          title: "Вход",
          auth: false
      }
    },
    clientRoutes,
    courierRouters,
    adminRoutes,
    ...errorRoutes,
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, _, next) => {
  document.title = postfix(to.meta.title) || 'B&B Logistic';
  next();
});

export default router;
