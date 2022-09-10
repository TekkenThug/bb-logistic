import Error from "@/views/Errors/Error";

export default [
    {
      path: "/404",
      component: Error,
      name: 'error',
      props: {
          title: "404",
          text: "Страница не найдена"
      },
      meta: {
          title: "404"
      }
    },
    {
        path: "/403",
        component: Error,
        name: 'forbidden',
        props: {
            title: "403",
            text: "Недостаточно прав"
        },
        meta: {
            title: "403"
        }
    }
]