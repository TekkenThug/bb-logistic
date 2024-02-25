import DefaultLayout from "@/layouts/default";
import OpenedOrders from "@/views/courier/OpenedOrders";
import ClosedOrders from "@/views/courier/ClosedOrders";

export default {
  path: "/courier",
  component: DefaultLayout,
  redirect: "/courier/open",
  meta: {
      auth: {
          roles: 3,
          forbiddenRedirect: { name: 'forbidden' },
      }
  },
  props: {
    role: 'courier',
  },
  children: [
      {
          path: "open",
          meta: {
            title: "Доступные заявки"
          },
          component: OpenedOrders
      },
      {
          path: "close",
          component: ClosedOrders,
          meta: {
            title: "Завершенные заявки"
          },
      }
  ]
}