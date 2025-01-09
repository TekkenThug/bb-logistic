<template>
  <div
    class="client__item"
    :class="{ 'dvd': deliveryType === 'ДВД' }"
  >
    <h4 class="client__item-title">
      {{ role === 'admin' ? `№ ${id} - ${userName}` : `Заявка № ${id}` }} <span
        class="status"
        :class="status"
      >{{
        setStatusOrder
      }}</span>

      <span
        v-if="courierName"
        style="font-size: 16px"
        class="mt-2 d-block"
      >Курьер: {{
        courierName
      }}, {{ courierPhone }}</span>

      <div class="buttons">
        <router-link
          v-if="(status === 'not-allocated' && role === 'client') || role === 'admin'"
          :to="{ path: role === 'admin' ? '/admin/orders/' + id:'/client/list/' + id}"
          class="btn edit-order"
          title="Изменить"
        >
          <i class="fas fa-pen" />
        </router-link>
        <button
          v-if="(status === 'not-allocated' && role === 'client') || role === 'admin'"
          class="btn delete-order"
          title="Отменить"
          @click="showModal = true"
        >
          <i class="fas fa-times" />
        </button>
        <button
          type="button"
          class="btn btn-more"
          title="Раскрыть"
          @click="showMore = !showMore"
        >
          <i
            class="fas fa-chevron-down"
            :class="{ active: showMore }"
          />
        </button>
      </div>
      <div class="short-descr">
        <span class="date">{{ setOrderDate }}</span>
        <span class="address mx-2">{{ deliveryAddress }}</span>
        <span class="type">{{ deliveryType }}</span>
        <div
          v-if="selectCourier && role === 'admin'"
          class="d-flex align-items-center"
        >
          <select
            v-model="courierId"
            class="form-select d-inline-block"
          >
            <option
              value="not"
              selected
              disabled
            >
              Выберите курьера
            </option>
            <option
              v-for="courier in couriers"
              :key="courier.id"
              :value="courier.id"
            >
              {{ courier.name }} - {{ courier.courier_comment }}
            </option>
          </select>
          <button
            class="btn btn-primary"
            @click="$emit('setCourier', id, courierId)"
          >
            Назначить
          </button>
        </div>
      </div>
    </h4>

    <transition name="fade">
      <div v-show="showMore">
        <div class="client__item-info">
          <div
            v-if="role === 'courier' && fenceAddress"
            class="info"
          >
            Адрес забора: <span>{{ fenceAddress }}</span>
          </div>
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
          <div
            v-if="clientPay"
            class="info"
          >
            Плата с клиента: <span>Да - {{ clientPay }}</span>
          </div>
          <div
            v-if="comment"
            class="info"
          >
            Комментарий: <span>{{ comment }}</span>
          </div>
          <div class="info">
            Товары к доставке:
            <span
              v-for="product in products"
              :key="product.id"
            >{{ product.name }} - {{
              product.count
            }} шт.</span>
          </div>
        </div>
        <div
          v-if="role === 'courier'"
          class="buttons mt-3"
        >
          <button
            v-if="status === 'pending'"
            class="btn btn-primary"
            @click="$emit('statusEvent', 'courier', id)"
          >
            Взять заказ
          </button>
          <button
            v-if="status === 'courier'"
            class="btn btn-primary"
            @click="$emit('statusEvent', 'finished', id, payMethod)"
          >
            Отгрузить
          </button>
          <button
            v-if="status === 'courier'"
            class="btn btn-danger"
            @click="$emit('statusEvent', 'return', id)"
          >
            Возврат
          </button>
          <div
            v-if="status === 'courier'"
            class="mt-3"
          >
            <div class="form-check">
              <input
                id="flexRadioDefault1"
                v-model="payMethod"
                value="cash"
                class="form-check-input"
                type="radio"
                name="flexRadioDefault"
              >
              <label
                class="form-check-label"
                for="flexRadioDefault1"
              >
                Наличный расчёт
              </label>
            </div>
            <div class="form-check">
              <input
                id="flexRadioDefault2"
                v-model="payMethod"
                value="card"
                class="form-check-input"
                type="radio"
                name="flexRadioDefault"
                checked
              >
              <label
                class="form-check-label"
                for="flexRadioDefault2"
              >
                Оплата картой
              </label>
            </div>
          </div>
        </div>
      </div>
    </transition>

    <popup
      v-if="showModal"
      @server-event="deleteOrder"
      @close="showModal = false"
    >
      <template #header>
        <h3>
          Удаление заявки
        </h3>
      </template>
      <template #body>
        <p>
          Вы действительно хотите удалить зявку?
        </p>
      </template>
    </popup>
  </div>
</template>

<script>
export default {
    name: "OrderRow",
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

        fenceAddress: {
            type: String,
            default: null
        }
    },
    data() {
        return {
            showMore: false,
            showModal: false,
            selectCourier: this.status === "not-allocated",
            courierId: 'not',
            payMethod: 'cash',
        }
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
            else if (this.status === 'finished')
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
.client__item {
    z-index: auto;
}

.client__item-info {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    column-gap: 10px;
    row-gap: 20px;
}

.client__item-info .info {
    margin-top: 0;
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

@media (max-width: 768px) {
    .client__item-info {
        grid-template-columns: 1fr 1fr 1fr;
    }
}

@media (max-width: 576px) {
    .client__item-info {
        grid-template-columns: 1fr 1fr;
    }
}
</style>
