<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="client__list client-tab">
                <div class="client__titles mb-3">
                    <h4>Выполненных заказов: {{ orders.length }}</h4>
                    <h4>Наличные: {{ cash }} руб.</h4>
                    <h4>Безналичный расчет: {{ credit }} руб.</h4>
                </div>
                <h2 v-if="orders.length === 0 && !preloader" class="text-center">Заявок нет</h2>
                <preloader v-if="preloader" />
                <OrderRow v-for="order in orders"
                          :role="'courier'"
                          :key="order.id"
                          :id="order.id"
                          :status="order.status"
                          :create-date="order.created_at"
                          :delivery-type="order.delivery_type"
                          :delivery-address="order.delivery_address"
                          :delivery-time="order.delivery_time"
                          :delivery-date="order.delivery_date"
                          :client-phones="order.delivery_phones"
                          :client-fullname="order.delivery_fio"
                          :comment="order.delivery_comment"
                          :client-pay="order.delivery_pay"
                          :products="order.goods"
                          @statusEvent="changeOrderStatus"
                />
            </div>
        </div>
    </div>
</template>

<script>
import OrderRow from "../../components/OrderRow";

export default {
    name: "ClosingOrders",
    components: { OrderRow },
    data() {
      return {
          credit: 0,
          cash: 0,
          preloader: true,
          orders: []
      }
    },
    methods: {
        getOrders() {
            this.preloader = true;
            this.orders = [];
            axios.get(`/orders?courier=true`).then(res => {
                if (res.data.status === 'success') {
                    this.preloader = false;
                    this.orders = res.data.orders
                    this.credit = res.data.payments.credit
                    this.cash = res.data.payments.cash
                }
            })
        },
        changeOrderStatus(status, id) {
            axios.patch(`/orders/${id}?role=courier&status=${status}`).then(res => {
                if (res.data.status === 'success') {
                    this.getOrders();
                } else {
                    console.log("Невозможно обновить статус")
                }
            })
        }
    },
    beforeMount() {
        this.getOrders();
    }
}
</script>

<style scoped>

</style>
