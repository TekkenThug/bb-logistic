import DefaultLayout from "@/layouts/default";
import OrderList from "@/views/client/OrderList";
import CreateOrder from "@/views/client/CreateOrder";
import EditOrder from "@/views/client/EditOrder"
import Fulfillment from "@/views/client/Stock";

export default {
  path: "/client",
  component: DefaultLayout,
  redirect: "/client/create",
  meta: {
      auth: {
          roles: 2,
          forbiddenRedirect: { name: 'forbidden' },
      }
  },
  props: {
    role: "client"
  },
  children: [
      {
          path: "create",
          meta: {
            title: "Создать заявку"
          },
          component: CreateOrder
      },
      {
          path: "list",
          component: OrderList,
          meta: {
            title: "Список заявок"
          },
      },
      {
          path: "list/:order_id",
          component: EditOrder,
          meta: {
            title: "Изменить заказ"
          },
      },
      {
          path: "fulfillment",
          component: Fulfillment,
          meta: {
            title: "Фулфилмент"
          },
      }
  ]
}