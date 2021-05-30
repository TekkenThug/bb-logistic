<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="admin-orders overall">
                <h4>Список заявок:</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <SearchInput v-model="searchText" class="flex-grow-1" style="margin-right: 10px" placeholder="Поиск по номеру заявки..." />
                    <router-link to="/admin/new-order" style="width: 200px" class="flex-shrink-0 btn btn-primary">Создать
                        новую заявку</router-link>
                </div>
                <SelectFilter v-model="filter" />
                <preloader v-if="preloader" />
                <h2 v-if="orders.length === 0 && !preloader" class="text-center">Заявок нет</h2>
                <div class="admin__client-list">
                    <OrderRow
                        v-for="order in orders"
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
                        :role="role"
                        :user-name="order.client_name"
                        :couriers="couriers"
                        :courier-name="order.courier_name"
                        :courier-phone="order.courier_phone"
                        @setCourier="setCourier"
                    />
                </div>
            </div>
<!--            {{ $orders->links() }}-->
        </div>
    </div>
</template>

<script>
import OrderRow from "../../components/OrderRow";
import SearchInput from "../../components/SearchInput";
import SelectFilter from "../../components/SelectFilter";

export default {
    name: "OrderList",
    components: { SearchInput, OrderRow, SelectFilter },
    data() {
        return {
            role: 'admin',
            preloader: true,
            stopSearch: false,
            orders: [],
            couriers: [],
            searchText: "",
            filter: ""
        }
    },
    watch: {
        searchText() {
            this.getOrders();
        },
        filter() {
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
    methods: {
        getOrders() {
            if (!this.stopSearch) {
                this.stopSearch = true;
                this.orders= [];
                this.preloader = true;
                axios.get(`/orders?id=${this.searchText}`).then(res => {
                    this.orders = res.data.orders;
                    this.preloader = false;
                    this.stopSearch = false;
                })
            }
        },
        setCourier(id, courierId) {
            if (+courierId) {
                axios.patch(`/orders/${id}?role=admin&fast=true`, {
                    courier_id: courierId
                }).then(res => {
                    if (res.data.status === "success") {
                        this.updateOrdersPage();
                    } else {
                        console.log("Ошибка на получении заявок")
                    }
                })
            }
        },
        updateOrdersPage() {
            if (!this.stopSearch) {
                this.preloader = true;
                this.orders = [];
                axios.get('/orders').then(res => {
                    this.preloader = false;
                    this.orders = res.data.orders;
                });
            }
        }
    },
    mounted() {
        axios.get('/orders?role=admin').then(res => {
            this.orders = res.data.orders;
            this.preloader = false;
        });

        axios.get('/couriers').then(res => {
            this.couriers = res.data.couriers;
        });
    }
}
</script>

<style scoped>

</style>
