<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <preloader class="mt-5" v-if="preloader" />
            <div v-else class="admin-client overall">
                <h2 class="admin-client__name">{{ client.name }}</h2>
                <h5>Наличный расчет: {{ cash }} руб.</h5>
                <h5>Безналичный расчет: {{ credit }} руб.</h5>
                <button @click="displayUserSettings = !displayUserSettings" class="btn btn-primary w-100">
                    {{ btnMsg }}
                </button>
                <EditUserData v-if="displayUserSettings"
                              :user="'client'"
                              :obj="{name: client.name, email: client.email, address: client.delivery_address}"
                              @serialize="updateClient"
                />
                <form class="admin-client__required-form">
                    <button @click="displayCashAttempt = !displayCashAttempt"
                            class="btn btn-primary w-100 btn-change-cash"
                            type="button">
                        Сдать деньги клиенту
                    </button>
                    <div v-if="displayCashAttempt" class="warning">
                        <b class="mb-2">Вы подтверждаете действие?</b>
                        <button @click.prevent="cashFlowMove" class="btn btn-warning w-100" type="submit">Да</button>
                    </div>
                </form>
                <div class="admin-client__filter">
                <h5>Фильтр по типу доставки:</h5>
                <button @click="getClientOrders('Стандарт')" class="btn btn-secondary btn-type-filter">Доставка</button>
                <button @click="getClientOrders('ДВД')" class="btn btn-secondary btn-type-filter">ДВД</button>
            </div>
            <div class="admin-client__orders">
                <h5>Список заявок:</h5>
                <div class="admin-client__orders-list">
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
                        :role="'admin'"
                        :user-name="order.client_name"
                        :couriers="couriers"
                        :courier-name="order.courier_name"
                        :courier-phone="order.courier_phone"
                        @setCourier="setCourier"
                    />
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
import OrderRow from "../../components/OrderRow";
import EditUserData from "../../components/EditUserData";

export default {
    name: "ClientPage",
    components: { OrderRow, EditUserData },
    data() {
        return {
            preloader: true,
            displayUserSettings: false,
            displayCashAttempt: false,
            client: [],
            couriers: [],
            orders: [],

            cash: 0,
            credit: 0,
        }
    },
    computed: {
        btnMsg() {
            return this.displayUserSettings ? "Скрыть настройки" : "Показать настройки пользователя"
        },
    },
    methods: {
        setCourier(id, courierId) {
            if (+courierId) {
                axios.patch(`/orders/${id}?role=admin&fast=true`, {
                    courier_id: courierId
                }).then(res => {
                    if (res.data.status === "success") {
                        this.updateOrdersPage();
                    } else {
                        console.log("Ошибка на назначении курьера")
                    }
                })
            }
        },
        getClientOrders(filter = '') {
            axios.get(`/clients/${this.$route.params.id}?filter=${filter}`)
                .then(res => {
                    if (res.data.status !== 'success') this.$router.push('/admin/clients')
                    else {
                        this.client = res.data.client;
                        this.orders = res.data.clientOrders;
                        this.couriers = res.data.couriers;
                        this.credit = res.data.money.credit;
                        this.cash = res.data.money.cash;
                        this.preloader = false;
                    }
                })
        },
        updateClient(obj) {
            axios.patch(`/clients/${this.client.id}`, obj)
                .then(res => {
                    if (res.data.status === 'success') {
                        this.displayUserSettings = false;
                    } else {
                        console.log('Ошибка при обновлении клиента')
                    }
                })
        },
        cashFlowMove() {
            this.preloader = true;
            axios.patch(`/clients/${this.client.id}?payment=true`).then(res => {
                if (res.data.status === 'success') {
                    this.preloader = false;
                }
            })
        }
    },
    beforeMount() {
        this.getClientOrders();
    }
}
</script>

<style scoped>

</style>
