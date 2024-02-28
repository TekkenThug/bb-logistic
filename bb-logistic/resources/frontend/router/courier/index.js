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
          name: "courier-opened-orders",
          meta: {
            title: "Доступные заявки"
          },
          component: OpenedOrders
      },
      {
          path: "close",
          name: "courier-closed-orders",
          component: ClosedOrders,
          meta: {
            title: "Завершенные заявки"
          },
      }
  ]
}