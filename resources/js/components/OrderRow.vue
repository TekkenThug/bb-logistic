<template>
    <div class="client__item" :class="{ 'dvd': deliveryType === 'ДВД' }">
        <h4 class="client__item-title">
            {{ role === 'admin' ? `№ ${id} - ${userName}` : `Заявка № ${id}` }} <span class="status" :class="status">{{ setStatusOrder }}</span>

            <span v-if="courierName" style="font-size: 16px" class="mt-2 d-block">Курьер: {{ courierName }}, {{ courierPhone }}</span>

            <div class="buttons">
                    <router-link :to="{ path: '/client/list/' + id}"
                                 v-if="(status === 'not-allocated' && role === 'client') || role === 'admin'"
                                 class="btn edit-order"
                                 title="Изменить">
                        <i class="fas fa-pen"></i>
                    </router-link>
                    <button @click="showModal = true"
                            v-if="(status === 'not-allocated' && role === 'client') || role === 'admin'"
                            class="btn delete-order"
                            title="Отменить">
                        <i class="fas fa-times"></i>
                    </button>
                    <button @click="showMore = !showMore" type="button" class="btn btn-more" title="Раскрыть">
                        <i class="fas fa-chevron-down" :class="{ active: showMore }"></i>
                    </button>
            </div>
            <div class="short-descr">
                <span class="date">{{ setOrderDate }}</span>
                <span class="address mx-2">{{ deliveryAddress }}</span>
                <span class="type">{{ deliveryType }}</span>
                <div v-if="selectCourier && role === 'admin'" class="d-flex align-items-center">
                    <select v-model="courierId" class="form-select d-inline-block">
                        <option value="not" selected disabled>Выберите курьера</option>
                        <option v-for="courier in couriers" :key="courier.id" :value="courier.id">
                            {{ courier.name }} - {{ courier.courier_comment }}
                        </option>
                    </select>
                    <button @click="$emit('setCourier', id, courierId)" class="btn btn-primary">Назначить</button>
                </div>
            </div>
        </h4>

        <transition name="fade">
            <div v-show="showMore" class="client__item-info">
                <div class="info">
                    Дата доставки: <span>{{ deliveryDate }}</span>
                </div>
                <div class="info">
                    Время доставки: <span>{{ deliveryTime }}</span>
                </div>
                <div class="info">
                    Имя клиента: <span>{{ clientFullname }}</span>
                </div>
                <div class="info">
                    Контакты: <span style="white-space: break-spaces">{{ clientPhones }}</span>
                </div>
                <div v-if="clientPay" class="info">
                    Плата с клиента: <span>Да - {{ clientPay }}</span>
                </div>
                <div v-if="comment" class="info">
                    Комментарий: <span>{{ comment }}</span>
                </div>
                <div class="info">
                    Товары к доставке:
                    <span v-for="product in products" :key="product.id">{{ product.name }} - {{ product.count }} шт.</span>
                </div>

            </div>
        </transition>

        <popup v-if="showModal" @serverEvent="deleteOrder" @close="showModal = false">
            <h3 slot="header">Удаление заявки</h3>
            <p slot="body">
                Вы действительно хотите удалить зявку?
            </p>
        </popup>
    </div>
</template>

<script>
export default {
    name: "OrderRow",
    data() {
        return {
            showMore: false,
            showModal: false,
            selectCourier: this.status === "not-allocated",
            courierId: 'not',
        }
    },
    props: {
        id: {
            required: true,
            type: Number,
        },
        status: {
            type: String
        },
        createDate: {
            type: String
        },
        deliveryType: {
            type: String,
        },
        deliveryAddress: {
            type: String
        },
        deliveryDate: {
            type: String
        },
        deliveryTime: {
            type: String
        },
        clientFullname: {
            type: String
        },
        clientPhones: {
            type: String
        },
        clientPay: {
            type: String
        },
        comment: {
            type: String,
        },
        products: {
            type: Array
        },
        role: {
            type: String,
            default: 'client'
        },
        userName: {
            type: String,
            default: 'User'
        },
        couriers: {
            type: Array,
            default() {
                return [];
            }
        },

        courierName: {
            type: String,
            default: ""
        },
        courierPhone: {
            type: String,
            default: ""
        },
    },
    computed: {
        setStatusOrder() {
            if (this.status === 'not-allocated')
                return 'Не распределено'
            else if (this.status === 'pending')
                return 'Ожидает забора товара'
            else if (this.status === 'stock')
                return 'На складе'
            else if (this.status === 'courier')
                return 'У курьера'
            else if (this.status === 'finish')
                return 'Отгружено'
            else if (this.status === 'return')
                return 'Возврат'
        },
        setOrderDate() {
            let rawDate = new Date(this.createDate);

            let date = new Intl.DateTimeFormat('ru', {
                hour12: false,
                year: 'numeric',
                hour: "numeric",
                minute: "numeric",
                month: '2-digit',
                day: '2-digit'
            }).format(rawDate);

            return `${date}`;
        },
    },
    methods: {
        deleteOrder() {
            axios.delete(`/orders/${this.id}`)
                .then((res) => {
                    if (res.data.status === "success") {
                        this.showModal = false;
                        setTimeout(() => {
                            this.$destroy();
                            this.$el.parentNode.removeChild(this.$el);
                        }, 500);

                    } else {
                        console.log("Ошибка!")
                    }
                })
        },
    }
}
</script>

<style scoped>
    .client__item-info {
        display: flex;
        align-items: flex-start;
        flex-wrap: wrap;
    }
    .client__item-info .info {
        margin-top: 0;
        margin-right: 40px;
        margin-bottom: 20px;
    }
    .fa-chevron-down {
        transition: all 0.2s ease
    }
    .fa-chevron-down.active {
        transform: rotate(180deg);
    }

    .form-select {
        margin: 15px 0;
        margin-right: 10px;
        max-width: 400px;
    }
</style>
