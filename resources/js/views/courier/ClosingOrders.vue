<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="client__list client-tab">
                <div class="client__titles mb-3">
                    <h4>Выполненных заказов: {{ count }}</h4>
                    <h4>Наличные: {{ cash }} руб.</h4>
                    <h4>Безналичный расчет: {{ credit }} руб.</h4>
                </div>
                <OrderRow />
            </div>
        </div>
    </div>
</template>

<script>
import OrderRow from "../../components/OrderRow";

export default {
    name: "ClosingOrders",
    data() {
      return {
          credit: 0,
          cash: 0,
          count: 0
      }
    },
    components: {OrderRow}
}
</script>

<style scoped>

</style>
