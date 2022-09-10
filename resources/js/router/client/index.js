import Client from "@/views/client/Client";
import ClientOrderList from "@/views/client/OrderList";
import ClientCreateOrder from "@/views/client/CreateOrder";
import ClientEditOrder from "@/views/client/EditOrder"
import ClientFulfillment from "@/views/client/Stock";

export default {
  path: "/client",
  component: Client,
  redirect: "/client/create",
  meta: {
      auth: {
          roles: 2,
          forbiddenRedirect: { name: 'forbidden' },
      }
  },
  children: [
      {
          path: "create",
          meta: {
            title: "Создать заявку"
          },
          component: ClientCreateOrder
      },
      {
          path: "list",
          component: ClientOrderList,
          meta: {
            title: "Список заявок"
          },
      },
      {
          path: "list/:order_id",
          component: ClientEditOrder,
          meta: {
            title: "Изменить заказ"
          },
      },
      {
          path: "fulfillment",
          component: ClientFulfillment,
          meta: {
            title: "Фулфилмент"
          },
      }
  ]
}