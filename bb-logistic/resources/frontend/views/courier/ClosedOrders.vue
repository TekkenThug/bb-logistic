<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="client__list client-tab">
                <div class="client__titles mb-3">
                    <h4>Выполненных заказов: {{ orders.length }}</h4>
                    <h4>Наличные: {{ cash }} руб.</h4>
                    <h4>Безналичный расчет: {{ credit }} руб.</h4>
                </div>

                <UIPreloader v-if="isLoading" />

                <h2 v-else-if="orders.length === 0" class="text-center">
                    Заявок нет
                </h2>

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
import OrderRow from "@/components/order-row";

export default {
    name: "ClosedOrders",
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
        async getOrders() {
            this.isLoading = true;
            this.orders = [];
            const { data } = await axios.get(`/orders?courier=true`);

            if (data.status === 'success') {
                this.isLoading = false;
                this.orders = data.orders
                this.credit = data.payments.credit
                this.cash = data.payments.cash
            }
        },

        async changeOrderStatus(status, id) {
            const { data } = await axios.patch(`/orders/${id}?role=courier&status=${status}`);

            if (data.status === 'success') {
                this.getOrders();
            } else {
                console.log("Невозможно обновить статус")
            }
        }
    },
    create() {
        this.getOrders();
    }
}
</script>
