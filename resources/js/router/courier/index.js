import Courier from "@/views/courier/Courier";
import CourierOpenOrders from "@/views/courier/OpenOrders";
import CourierClosingOrders from "@/views/courier/ClosingOrders";

export default {
  path: "/courier",
  component: Courier,
  redirect: "/courier/open",
  meta: {
      auth: {
          roles: 3,
          forbiddenRedirect: { name: 'forbidden' },
      }
  },
  children: [
      {
          path: "open",
          meta: {
            title: "Доступные заявки"
          },
          component: CourierOpenOrders
      },
      {
          path: "close",
          component: CourierClosingOrders,
          meta: {
            title: "Завершенные заявки"
          },
      }
  ]
}