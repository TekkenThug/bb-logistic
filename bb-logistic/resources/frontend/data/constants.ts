export const ROLES = {
  1: 'admin',
  2: 'client',
  3: 'courier'
}

export const NAVIGATION = {
  "client": [
    {
      icon: "pencil",
      routeName: "client-create-order",
      text: "Оформить доставку"
    },
    {
      icon: "list",
      routeName: "client-order-list",
      text: "Список заявок"
    },
    {
      icon: "box",
      routeName: "client-fullfilment",
      text: "Фуллфилмент"
    }
  ],
  "courier": [
    {
      icon: "directions",
      routeName: "courier-opened-orders",
      text: "Открытые заказы"
    },
    {
      icon: "stopwatch",
      routeName: "courier-closed-orders",
      text: "Закрытые заказы"
    },
  ],
  "admin": [
    {
      icon: "lucide:user-round-pen",
      routeName: "admin-create-user",
      text: "Создать пользователя"
    },
    {
      icon: "lucide:users-round",
      routeName: "admin-client-list",
      text: "Список клиентов"
    },
    {
      icon: "lucide:users-round",
      routeName: "admin-courier-list",
      text: "Список курьеров"
    },
    {
      icon: "lucide:mail-warning",
      routeName: "admin-order-list",
      text: "Список заявок"
    },
    {
      icon: "lucide:package",
      routeName: "admin-fullfilment",
      text: "Фулфилмент"
    }
  ]
}