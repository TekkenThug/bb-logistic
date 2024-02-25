<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">

            <div id="order-list" class="client__list client-tab">
                <StatusSelect v-model="filter" />

                <UIPreloader v-if="isLoading" />

                <h2 v-else-if="orders.length" class="text-center">
                    Заявок нет
                </h2>

                <OrderRow v-for="order in orders"
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
                          :courier-name="order.courier_name"
                          :courier-phone="order.courier_phone"
                />
            </div>
        </div>
    </div>
</template>

<script>
import { getOrders } from "@/services/api/orders";

import OrderRow from "@/components/order-row";
import StatusSelect from "@/components/status-select";

export default {
    name: "OrderList",
    components: { OrderRow, StatusSelect },
    data() {
        return {
            isLoading: true,
            stopSearch: false,
            orders: [],
            filter: "",
        }
    },
    watch: {
        filter() {
            this.getOrders();
        }
    },

    methods: {
        async getOrders() {
            if (!this.stopSearch) {
                this.stopSearch = true;
                this.orders= [];
                this.isLoading = true;

                const { data } = await getOrders({ filter: this.filter });

                this.orders = data.orders;
                this.isLoading = false;
                this.stopSearch = false;
            }
        }
    },

    async mounted() {
        const { data } = await getOrders({ role: "client" });
        
        this.orders = data.orders;
        this.isLoading = false;
    }
}
</script>