<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">

            <div id="order-list" class="client__list client-tab">
                <SelectFilter v-model="filter" />
                <preloader v-if="preloader" />
                <h2 v-if="orders.length === 0 && !preloader" class="text-center">Заявок нет</h2>
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
import OrderRow from "../../components/OrderRow";
import SelectFilter from "../../components/SelectFilter";

export default {
    name: "OrderList",
    components: { OrderRow, SelectFilter },
    data() {
        return {
            preloader: true,
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
        getOrders() {
            if (!this.stopSearch) {
                this.stopSearch = true;
                this.orders= [];
                this.preloader = true;
                axios.get(`/orders?filter=${this.filter}`).then(res => {
                    this.orders = res.data.orders;
                    this.preloader = false;
                    this.stopSearch = false;
                })
            }
        }
    },
    mounted() {
        axios.get('/orders?role=client').then(res => {
           this.orders = res.data.orders;
           this.preloader = false;
        })
    }
}
</script>

<style scoped>

</style>
