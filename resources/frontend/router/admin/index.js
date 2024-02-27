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
          meta: {
            title: "Создать пользователя"
          },
          component: CreateUser
      },
      {
          path: "clients",
          meta: {
            title: "Список клиентов"
          },
          component: AdminClientList
      },
      {
          path: "clients/:id",
          meta: {
            title: "Клиент"
          },
          component: AdminClientPage
      },
      {
          path: "couriers",
          meta: {
            title: "Список курьеров"
          },
          component: AdminCourierList
      },
      {
          path: "couriers/:id",
          meta: {
            title: "Курьер"
          },
          component: AdminCourierPage
      },
      {
          path: "orders",
          meta: {
            title: "Список заявок"
          },
          component: AdminOrderList
      },
      {
          path: "orders/:id",
          meta: {
            title: "Редактировать заявку"
          },
          component: AdminEditOrder
      },
      {
          path: "new-order",
          meta: {
            title: "Создать заявку"
          },
          component: AdminCreateOrder
      },
      {
          path: "fulfillment",
          meta: {
            title: "Фулфилмент"
          },
          component: AdminFulfillment
      }
  ]
}