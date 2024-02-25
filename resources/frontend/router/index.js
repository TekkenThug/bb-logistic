import VueRouter from 'vue-router';

import Auth from "@/views/auth";

// import errorRoutes from './errors';
// import adminRoutes from './admin';
import courierRouters from './courier';
import clientRoutes from './client';

const postfix = (str) => `${str} - B&B Logistic`;

const routes = [
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
    // adminRoutes,
    // ...errorRoutes,
];

const router = new VueRouter({
    mode: "history",
    routes
});

router.beforeEach((to, _, next) => {
  document.title = postfix(to.meta.title) || 'B&B Logistic';
  next();
});

export default router;
