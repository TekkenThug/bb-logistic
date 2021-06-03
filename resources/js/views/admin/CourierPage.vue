<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <preloader class="mt-5" v-if="preloader" />
            <div v-else class="admin-client overall">
                <h2 class="admin-client__name">{{ courier.name }}</h2>
                <!--                <h5>Наличный расчет: {{ $cash }} руб.</h5>-->
                <!--                <h5>Безналичный расчет: {{ $credit }} руб.</h5>-->
                <button @click="displayUserSettings = !displayUserSettings" class="btn btn-primary w-100">
                    {{ btnMsg }}
                </button>
                <EditUserData v-if="displayUserSettings"
                              :user="'courier'"
                              :obj="{name: courier.name, email: courier.email, phone: courier.phone_number}"
                              @serialize="updateCourier"
                />
                <form class="admin-client__required-form">
                    <button class="btn btn-primary w-100 btn-change-cash" type="button">Взять деньги у курьера</button>
                    <div class="warning">
                        <b class="mb-2">Вы подтверждаете действие?</b>
                        <button class="btn btn-warning w-100" type="submit">Да</button>
                    </div>
                </form>
                <div class="mb-5">
                    <h5>Комментарий к курьеру:</h5>
                    <textarea v-model="comment" name="courier_comment" class="form-control" maxlength="256"></textarea>
                    <button @click="setComment" class="btn btn-warning w-100 mt-3" type="submit">Сохранить</button>
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

                            :courier-name="order.courier_name"
                            :courier-phone="order.courier_phone"
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
    name: "CourierPage",
    components: { OrderRow, EditUserData },
    data() {
        return {
            preloader: true,
            displayUserSettings: false,
            comment: "",
            courier: [],
            orders: []
        }
    },
    computed: {
        btnMsg() {
            return this.displayUserSettings ? "Скрыть настройки" : "Показать настройки пользователя"
        }
    },
    methods: {
        getCourierOrders() {
            axios.get(`/couriers/${this.$route.params.id}`)
                .then(res => {
                    if (res.data.status !== 'success') this.$router.push('/admin/clients')
                    else {
                        this.courier = res.data.courier;
                        this.comment = res.data.courier.courier_comment
                        this.orders = res.data.courierOrders;
                        this.preloader = false;
                    }
                }).catch(() => this.$router.push('/admin/couriers'));
        },
        updateCourier(obj) {
            axios.patch(`/couriers/${this.courier.id}`, obj)
                .then(res => {
                    if (res.data.status === 'success') {
                        this.displayUserSettings = false;
                    } else {
                        console.log('Ошибка при обновлении курьера')
                    }
                })
        },
        setComment() {
            axios.patch(`/couriers/${this.courier.id}?comment=true`, {comment: this.comment})
                .then(res => {
                    if (res.data.status === 'success') {
                        console.log('Всё хорошо!')
                    } else {
                        console.log('Ошибка при добавлении комментария')
                    }
                })
        }
    },
    beforeMount() {
        this.getCourierOrders();
    }
}
</script>

<style scoped>

</style>
