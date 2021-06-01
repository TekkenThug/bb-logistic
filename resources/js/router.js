import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Auth from "./views/Auth";
import NotFound from "./views/NotFound";

import Client from "./views/client/Client";
import ClientOrderList from "./views/client/OrderList";
import ClientCreateOrder from "./views/client/CreateOrder";
import ClientEditOrder from "./views/client/EditOrder"

import Courier from "./views/courier/Courier";
import CourierOpenOrders from "./views/courier/OpenOrders";
import CourierClosingOrders from "./views/courier/ClosingOrders";

import Admin from "./views/admin/Admin";
import AdminCreateUser from "./views/admin/CreateUser";
import AdminClientList from "./views/admin/ClientList";
import AdminCourierList from "./views/admin/CourierList";
import AdminOrderList from "./views/admin/OrderList";
import AdminCreateOrder from "./views/admin/CreateOrder";
import AdminClientPage from "./views/admin/ClientPage";
import AdminCourierPage from "./views/admin/CourierPage";
import AdminEditOrder from "./views/admin/EditOrder";

const postfix = (str) => `${str} - B&B Logistic`;

const routes = [
    {
        path: "*",
        component: NotFound,
        meta: {
            title: postfix("404")
        }
    },
    {
        path: "/login",
        component: Auth,
        meta: {
            title: postfix("Вход"),
            notFoundRedirect: '/',
            forbiddenRedirect: '/',
            auth: false
        }
    },
    {
        path: "/client",
        component: Client,
        redirect: "/client/create",
        meta: {
            auth: {
                roles: 2,
                redirect: "/",
            }
        },
        children: [
            {
                path: "create",
                meta: {title: postfix("Создать заявку")},
                component: ClientCreateOrder
            },
            {
                path: "list",
                component: ClientOrderList,
                meta: {title: postfix("Список заявок")},
            },
            {
                path: "list/:order_id",
                component: ClientEditOrder,
                meta: {title: postfix("Изменить заказ")},
            }
        ]
    },
    {
        path: "/courier",
        component: Courier,
        redirect: "/courier/open",
        meta: {
            auth: {
                roles: 3,
                redirect: "/",
            }
        },
        children: [
            {
                path: "open",
                meta: {title: postfix("Доступные заявки")},
                component: CourierOpenOrders
            },
            {
                path: "close",
                component: CourierClosingOrders,
                meta: {title: postfix("Завершенные заявки")},
            }
        ]
    },
    {
        path: "/admin",
        component: Admin,
        redirect: "/admin/create-user",
        meta: {
            auth: {
                roles: 1,
                redirect: "/",
            }
        },
        children: [
            {
                path: "create-user",
                meta: {title: postfix("Создать пользователя")},
                component: AdminCreateUser
            },
            {
                path: "clients",
                meta: {title: postfix("Список клиентов")},
                component: AdminClientList
            },
            {
                path: "clients/:id",
                meta: {title: postfix("Клиент")},
                component: AdminClientPage
            },
            {
                path: "couriers",
                meta: {title: postfix("Список курьеров")},
                component: AdminCourierList
            },
            {
                path: "couriers/:id",
                meta: {title: postfix("Курьер")},
                component: AdminCourierPage
            },
            {
                path: "orders",
                meta: {title: postfix("Список заявок")},
                component: AdminOrderList
            },
            {
                path: "orders/:id",
                meta: {title: postfix("Редактировать заявку")},
                component: AdminEditOrder
            },
            {
                path: "new-order",
                meta: {title: postfix("Создать заявку")},
                component: AdminCreateOrder
            },
        ]
    }
];

export default new VueRouter({
    mode: "history",
    routes
});
