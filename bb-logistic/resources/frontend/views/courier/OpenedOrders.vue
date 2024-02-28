<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div id="open-orders" class="client__list client-tab active">
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
                          :fence-address="order.fenceAddress"
                          @statusEvent="changeOrderStatus"
                />
            </div>
        </div>
    </div>
</template>

<script>
import { getOrders, updateOrder } from "@/services/api/orders";
import OrderRow from "@/components/order-row";

export default {
    name: "OpenedOrders",
    components: { OrderRow },
    data() {
      return {
          isLoading: true,
          orders: []
      }
    },
    methods: {
        async getOrders() {
            this.isLoading = true;
            this.orders = [];
            const { data } = await getOrders({ filter: "open" });

            if (data.status === 'success') {
                this.isLoading = false;
                this.orders = data.orders
            }
        },

        async changeOrderStatus(status, id, payMethod = null) {
            const { data } = updateOrder(id, { role: "courier", status, payMethod });

            if (data.status === 'success') {
                this.getOrders();
            } else {
                console.log("Невозможно обновить статус")
            }
        }
    },
    beforeMount() {
        this.getOrders();
    }
}
</script>