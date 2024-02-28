import DefaultLayout from "@/layouts/default"
import CreateUser from "@/views/admin/CreateUser";

import AdminClientList from "@/views/admin/ClientList";
import AdminCourierList from "@/views/admin/CourierList";
import AdminOrderList from "@/views/admin/OrderList";
import AdminCreateOrder from "@/views/admin/CreateOrder";
import AdminClientPage from "@/views/admin/ClientPage";
import AdminCourierPage from "@/views/admin/CourierPage";
import AdminEditOrder from "@/views/admin/EditOrder";
import AdminFulfillment from "@/views/admin/Fulfillment";

export default {
  path: "/admin",
  component: DefaultLayout,
  props: {
    role: 'admin'
  },
  redirect: "/admin/create-user",
  meta: {
      auth: {
          roles: 1,
          forbiddenRedirect: { name: 'forbidden' },
      }
  },
  children: [
      {
          path: "create-user",
          name: "admin-create-user",
          meta: {
            title: "Создать пользователя"
          },
          component: CreateUser
      },
      {
          path: "clients",
          name: "admin-client-list",
          meta: {
            title: "Список клиентов"
          },
          component: AdminClientList
      },
      {
          path: "clients/:id",
          name: "admin-client",
          meta: {
            title: "Клиент"
          },
          component: AdminClientPage
      },
      {
          path: "couriers",
          name: "admin-courier-list",
          meta: {
            title: "Список курьеров"
          },
          component: AdminCourierList
      },
      {
          path: "couriers/:id",
          name: "admin-courier",
          meta: {
            title: "Курьер"
          },
          component: AdminCourierPage
      },
      {
          path: "orders",
          name: "admin-order-list",
          meta: {
            title: "Список заявок"
          },
          component: AdminOrderList
      },
      {
          path: "orders/:id",
          name: "admin-order",
          meta: {
            title: "Редактировать заявку"
          },
          component: AdminEditOrder
      },
      {
          path: "new-order",
          name: "admin-new-order",
          meta: {
            title: "Создать заявку"
          },
          component: AdminCreateOrder
      },
      {
          path: "fulfillment",
          name: "admin-fullfilment",
          meta: {
            title: "Фулфилмент"
          },
          component: AdminFulfillment
      }
  ]
}