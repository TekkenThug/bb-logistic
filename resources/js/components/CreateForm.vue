<template>
    <div class="client__order client-tab active">
        <form method="POST" class="client__order-form">

            <h4 v-if="newOrder" class="admin-create__form-title">Создание заявки</h4>
            <h4 v-else class="admin-create__form-title">Изменить заявку</h4>

            <div v-if="isAdmin" class="client__order-row">
                <h4 class="client__order-subtitle">Изменить статус:</h4>
                <div class="required">
                    <select v-model="deliveryStatus" class="form-control" name="order-status" required>
                        <option value="not-allocated" selected>Не распределен</option>
                        <option value="pending">Ожидается забор товара</option>
                        <option value="stock">Товар на складе</option>
                        <option value="courier">Товар у курьера</option>
                        <option value="return">Возврат/перенос</option>
                        <option value="finished">Отгружен</option>
                    </select>
                </div>
            </div>

            <div v-if="isAdmin" class="client__order-row">
                <h4 class="client__order-subtitle">От кого заказ:</h4>
                <div class="required">
                    <select v-model="user" class="form-control" name="order-client" required>
                        <option v-for="client in clients" :key="client.id" :value="client.id">{{ client.name }}</option>
                    </select>
                </div>
            </div>

            <div v-if="isAdmin" class="client__order-row">
                <h4 class="client__order-subtitle">Курьер:</h4>
                <div class="required">
                    <select v-model="courier" class="form-control" name="order-courier" required>
                        <option v-for="courier in couriers" :key="courier.id" :value="courier.id">{{ courier.name }}</option>
                    </select>
                </div>
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Тип доставки:</h4>
                <div class="client__order-field">
                    <label for="delivery-type-1">Стандарт</label>
                    <input v-model="deliveryType" required type="radio" name="delivery-type" id="delivery-type-1"
                           value="Стандарт" checked>
                </div>
                <div class="client__order-field">
                    <label for="delivery-type-2">ДВД</label>
                    <input v-model="deliveryType" required type="radio" name="delivery-type" id="delivery-type-2"
                           value="ДВД">
                </div>

            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Дата доставки:</h4>
                <div class="required">
                    <input v-model="date" required class="form-control" name="delivery-date" type="date"
                           :min="getTodayDate">
                </div>
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Время доставки:</h4>
                <div class="required">
                    <select v-model="time" required class="form-control" name="delivery-interval">
                        <option value="В любое время" selected>В любое время</option>
                        <option value="10.00 - 14.00">10.00 - 14.00</option>
                        <option value="14.00 - 18.00">14.00 - 18.00</option>
                        <option value="18.00 - 22.00">18.00 - 22.00</option>
                    </select>
                </div>
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Адрес доставки:</h4>
                <div class="required">
                    <input v-model="address" required class="form-control" type="text" name="delivery-address"
                           placeholder="Адрес доставки">
                </div>
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">ФИО:</h4>
                <div class="required">
                    <input v-model="fullname" required class="form-control" type="text" name="delivery-fullname"
                           placeholder="Введите ФИО клиента">
                </div>
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Контакты:</h4>
                <div class="fields-list required">
                    <PhoneInput v-model="contacts[index]" v-for="(input, index) in contacts" :key="index"/>
                </div>
                <button @click.prevent="addPhone" type="button" :disabled="contacts.length >= 3"
                        class="btn btn-primary client__order-add-number mt-3">
                    <i class="fas fa-plus"></i> Добавить номер
                </button>
            </div>

            <div class="client__order-row width">
                <h4 class="client__order-subtitle">Товары к доставке:</h4>
                <div class="client__order-list-wrap">
                    <table class="client__order-list">
                        <ProductRow :info="products[index]" v-model="products[index]" :key="index" v-for="(input, index) in products"/>
                    </table>
                    <button @click.prevent="addProduct" type="button"
                            class="btn btn-primary client__order-add-product mt-3"><i
                        class="fas fa-plus"></i>
                        Добавить товар
                    </button>
                </div>
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Оплата с клиента:</h4>
                <div class="client__order-field">
                    <label for="delivery-pay-yes">Да</label>
                    <input v-model="clientPay" id="delivery-pay-yes" type="radio" name="delivery-pay" :value="true">
                </div>
                <div class="client__order-field">
                    <label for="delivery-pay-no">Нет</label>
                    <input v-model="clientPay" id="delivery-pay-no" type="radio" name="delivery-pay" :value="false"
                           checked>
                </div>
                <input v-model="clientPayCost" class="form-control" name="delivery-pay-count" type="text"
                       placeholder="Какую сумму взять c клиента" :disabled="!clientPay">
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Комментарий:</h4>
                <textarea v-model="comment" class="form-control" name="delivery-comment"
                          placeholder="Комментарий к заказу"></textarea>
            </div>

            <button v-if="newOrder" @click.prevent="serializeForm" class="btn btn-primary">Оформить доставку</button>
            <button v-else @click.prevent="serializeForm" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>
</template>

<script>
import PhoneInput from "./form/PhoneInput";
import ProductRow from "./form/ProductRow";

export default {
    name: "CreateForm",
    components: {PhoneInput, ProductRow},
    props: {
        isAdmin: {
            type: Boolean,
            default: false
        },
        newOrder: {
            type: Boolean,
            default: false,
        },
        order: {
            type: Object,
            default() {
                return {}
            }
        },
        clients: {
            type: Array,
            default() {
                return []
            }
        },
        couriers: {
            type: Array,
            default() {
                return []
            }
        },
    },
    data() {
        return {
            deliveryType: "Стандарт",
            date: null,
            time: "В любое время",
            address: null,
            fullname: null,
            contacts: [""],
            products: [{}],
            clientPay: false,
            clientPayCost: null,
            comment: "",

            user: "",
            courier: "",
            deliveryStatus: "not-allocated"
        }
    },
    methods: {
        addPhone() {
            this.contacts.push("");
        },
        addProduct() {
            this.products.push({});
        },
        serializeForm() {
            // Валидация здесь должна быть
            this.$emit('serializeForm', {
                deliveryType: this.deliveryType,
                date: this.date,
                time: this.time,
                address: this.address,
                fullname: this.fullname,
                phones: this.contacts,
                products: this.products,
                clientPay: this.clientPayCost,
                comment: this.comment,

                user: this.user,
                courier: this.courier,
                deliveryStatus: this.deliveryStatus
            })
        },
        completedForm() {
            this.deliveryType = this.order.delivery_type;
            this.date = this.order.delivery_date;
            this.time = this.order.delivery_time;
            this.address = this.order.delivery_address;
            this.fullname = this.order.delivery_fio;
            this.contacts = this.order.delivery_phones.split('\n');
            this.clientPayCost = this.order.delivery_pay;
            this.clientPay = this.order.delivery_pay == null ? false : true;
            this.comment = this.order.delivery_comment;

            this.products = [];
            this.order.goods.forEach(product => {
                this.$set(this.products, this.products.length, {
                    name: product.name,
                    cost: product.cost,
                    count: product.count
                });
            })

            this.deliveryStatus = this.order.status;
            this.user = this.order.client_id;
            this.courier = this.order.courier_id;
        }
    },
    computed: {
        getTodayDate() {
            const date = new Date();
            const dd = String(date.getDate()).padStart(2, '0');
            const mm = String(date.getMonth() + 1).padStart(2, '0');
            const yyyy = date.getFullYear();
            return `${yyyy}-${mm}-${dd}`
        },
    },
    watch: {
        clientPay(val) {
            if (val === false) this.clientPayCost = null
        }
    }
}
</script>

<style scoped>

</style>
