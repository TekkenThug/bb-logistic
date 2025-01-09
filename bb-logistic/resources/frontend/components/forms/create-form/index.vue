<template>
  <div class="client__order client-tab active">
    <form
      method="POST"
      class="client__order-form"
    >
      <h4
        v-if="newOrder"
        class="admin-create__form-title"
      >
        Создание заявки
      </h4>
      <h4
        v-else
        class="admin-create__form-title"
      >
        Изменить заявку
      </h4>

      <div
        v-if="isAdmin"
        class="client__order-row"
      >
        <h4 class="client__order-subtitle">
          Изменить статус:
        </h4>
        <div class="required">
          <select
            v-model="deliveryStatus"
            class="form-control"
            name="order-status"
            required
          >
            <option
              value="not-allocated"
              selected
            >
              Не распределен
            </option>
            <option value="pending">
              Ожидается забор товара
            </option>
            <option value="stock">
              Товар на складе
            </option>
            <option value="courier">
              Товар у курьера
            </option>
            <option value="return">
              Возврат/перенос
            </option>
            <option value="finished">
              Отгружен
            </option>
          </select>
        </div>
      </div>

      <div
        v-if="isAdmin"
        class="client__order-row"
      >
        <h4 class="client__order-subtitle">
          От кого заказ:
        </h4>
        <div class="required">
          <select
            v-model="user"
            class="form-control"
            name="order-client"
            required
          >
            <option :value="1">
              От администратора
            </option>
            <option
              v-for="client in clients"
              :key="client.id"
              :value="client.id"
            >
              {{ client.name }}
            </option>
          </select>
        </div>
      </div>

      <div
        v-if="isAdmin"
        class="client__order-row"
      >
        <h4 class="client__order-subtitle">
          Курьер:
        </h4>
        <div class="required">
          <select
            v-model="courier"
            class="form-control"
            name="order-courier"
            required
          >
            <option
              v-for="courier in couriers"
              :key="courier.id"
              :value="courier.id"
            >
              {{ courier.name }}
            </option>
          </select>
        </div>
      </div>

      <div class="client__order-row">
        <h4 class="client__order-subtitle">
          Тип доставки:
        </h4>
        <div class="client__order-field">
          <label for="delivery-type-1">Стандарт</label>
          <input
            id="delivery-type-1"
            v-model="deliveryType"
            required
            type="radio"
            name="delivery-type"
            value="Стандарт"
            checked
          >
        </div>
        <div class="client__order-field">
          <label for="delivery-type-2">ДВД</label>
          <input
            id="delivery-type-2"
            v-model="deliveryType"
            required
            type="radio"
            name="delivery-type"
            value="ДВД"
          >
        </div>
      </div>

      <div class="client__order-row">
        <h4 class="client__order-subtitle">
          Дата доставки:
        </h4>
        <div class="required">
          <input
            v-model="date"
            required
            class="form-control"
            name="delivery-date"
            type="date"
            :min="getTodayDate"
          >
        </div>
      </div>

      <div class="client__order-row">
        <h4 class="client__order-subtitle">
          Время доставки:
        </h4>
        <div class="required">
          <select
            v-model="time"
            required
            class="form-control"
            name="delivery-interval"
          >
            <option
              value="В любое время"
              selected
            >
              В любое время
            </option>
            <option value="10.00 - 14.00">
              10.00 - 14.00
            </option>
            <option value="14.00 - 18.00">
              14.00 - 18.00
            </option>
            <option value="18.00 - 22.00">
              18.00 - 22.00
            </option>
          </select>
        </div>
      </div>

      <div class="client__order-row">
        <h4 class="client__order-subtitle">
          Адрес доставки:
        </h4>
        <div class="required">
          <input
            v-model="address"
            required
            class="form-control"
            type="text"
            name="delivery-address"
            placeholder="Адрес доставки"
          >
        </div>
      </div>

      <div class="client__order-row">
        <h4 class="client__order-subtitle">
          ФИО:
        </h4>
        <div class="required">
          <input
            v-model="fullname"
            required
            class="form-control"
            type="text"
            name="delivery-fullname"
            placeholder="Введите ФИО клиента"
          >
        </div>
      </div>

      <div class="client__order-row">
        <h4 class="client__order-subtitle">
          Контакты:
        </h4>
        <div class="fields-list required">
          <PhoneInput
            v-for="(input, index) in contacts"
            :key="index"
            v-model="contacts[index]"
          />
        </div>
        <button
          type="button"
          :disabled="contacts.length >= 3"
          class="btn btn-primary client__order-add-number mt-3"
          @click.prevent="addPhone"
        >
          <i class="fas fa-plus" /> Добавить номер
        </button>
      </div>

      <div class="client__order-row width">
        <h4 class="client__order-subtitle">
          Товары к доставке:
        </h4>
        <div class="client__order-list-wrap">
          <table class="client__order-list">
            <ProductRow
              v-for="(input, index) in products"
              :key="index"
              v-model="products[index]"
              :info="products[index]"
            />
          </table>
          <button
            type="button"
            class="btn btn-primary client__order-add-product mt-3"
            @click.prevent="addProduct"
          >
            <i
              class="fas fa-plus"
            />
            Добавить товар
          </button>
        </div>
      </div>

      <div class="client__order-row">
        <h4 class="client__order-subtitle">
          Оплата с клиента:
        </h4>
        <div class="client__order-field">
          <label for="delivery-pay-yes">Да</label>
          <input
            id="delivery-pay-yes"
            v-model="clientPay"
            type="radio"
            name="delivery-pay"
            :value="true"
          >
        </div>
        <div class="client__order-field">
          <label for="delivery-pay-no">Нет</label>
          <input
            id="delivery-pay-no"
            v-model="clientPay"
            type="radio"
            name="delivery-pay"
            :value="false"
            checked
          >
        </div>
        <input
          v-model="clientPayCost"
          class="form-control"
          name="delivery-pay-count"
          type="text"
          placeholder="Какую сумму взять c клиента"
          :disabled="!clientPay"
        >
      </div>

      <div class="client__order-row">
        <h4 class="client__order-subtitle">
          Комментарий:
        </h4>
        <textarea
          v-model="comment"
          class="form-control"
          name="delivery-comment"
          placeholder="Комментарий к заказу"
        />
      </div>

      <button
        v-if="newOrder"
        class="btn btn-primary"
        @click.prevent="serializeForm"
      >
        Оформить доставку
      </button>
      <button
        v-else
        class="btn btn-primary"
        @click.prevent="serializeForm"
      >
        Сохранить изменения
      </button>
    </form>
  </div>
</template>

<script>
import PhoneInput from "./components/PhoneInput";
import ProductRow from "./components/ProductRow";

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

            user: 1,
            courier: "",
            deliveryStatus: "not-allocated"
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
    }
}
</script>
