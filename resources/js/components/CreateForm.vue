<template>
    <div class="client__order client-tab active">
        <form method="POST"  class="client__order-form">

            <h4 v-if="newOrder" class="admin-create__form-title">Создание заявки</h4>
            <h4 v-else class="admin-create__form-title">Изменить заявку</h4>


<!--            <h3 class="w-100">Заявка №{{ id }}</h3>-->

<!--            <div class="client__order-row">-->
<!--                <h4 class="client__order-subtitle">Изменить статус:</h4>-->
<!--                <div class="required">-->
<!--                    <select class="form-control" name="order-status" required>-->
<!--                        <option value="not-allocated" selected>Не распределен</option>-->
<!--                        <option value="pending">Ожидается забор товара</option>-->
<!--                        <option value="stock">Товар на складе</option>-->
<!--                        <option value="courier">Товар у курьера</option>-->
<!--                        <option value="return">Возврат/перенос</option>-->
<!--                        <option value="finished">Отгружен</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="client__order-row">-->
<!--                <h4 class="client__order-subtitle">От кого заказ:</h4>-->
<!--                <div class="required">-->
<!--                    <select class="form-control" name="order-client" required>-->
<!--                        <option value="{{ Auth::user()->id }}" selected>От администратора</option>-->
<!--                        @foreach($clients as $client)-->
<!--                        <option value="{{ $client->id }}">{{ $client->name }}</option>-->
<!--                        @endforeach-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="client__order-row">-->
<!--                <h4 class="client__order-subtitle">Курьер:</h4>-->
<!--                <div class="required">-->
<!--                    <select class="form-control" name="order-courier" required>-->
<!--                        @foreach($couriers as $courier)-->
<!--                        <option value="{{ $courier->id }}">{{ $courier->name }} {{ $courier->courier_comment }}</option>-->
<!--                        @endforeach-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Тип доставки:</h4>
                <div class="client__order-field">
                    <label for="delivery-type-1">Стандарт</label>
                    <input v-model="deliveryType" required type="radio" name="delivery-type" id="delivery-type-1" value="Стандарт" checked>
                </div>
                <div class="client__order-field">
                    <label for="delivery-type-2">ДВД</label>
                    <input v-model="deliveryType" required type="radio" name="delivery-type" id="delivery-type-2" value="ДВД">
                </div>

            </div>

<!--            <div class="client__order-row">-->
<!--                <h4 class="client__order-subtitle">Тип заявки:</h4>-->
<!--                <div class="client__order-field">-->
<!--                    <label for="order-type-1">Забор</label>-->
<!--                    <input type="radio" name="order-type" id="order-type-1" value="Забор" checked>-->
<!--                </div>-->
<!--                <div class="client__order-field">-->
<!--                    <label for="order-type-2">Доставка</label>-->
<!--                    <input type="radio" name="order-type" id="order-type-2" value="Доставка">-->
<!--                </div>-->
<!--            </div>-->

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Дата доставки:</h4>
                <div class="required">
                    <input v-model="date" required class="form-control" name="delivery-date" type="date" :min="getTodayDate">
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
                    <PhoneInput v-model="contacts[index]" :key="index" v-for="(input, index) in phoneFields" />
                </div>
                <button @click.prevent="addPhone" :disabled="phoneFields.length === 3" class="btn btn-primary client__order-add-number mt-3">
                    <i class="fas fa-plus"></i> Добавить номер
                </button>
            </div>

            <div class="client__order-row width">
                <h4 class="client__order-subtitle">Товары к доставке:</h4>
                <div class="client__order-list-wrap">
                    <table class="client__order-list">
                        <ProductRow v-model="products[index]" :key="index" v-for="(input, index) in productFields" />
                    </table>
                    <button @click.prevent="addProduct" type="button" class="btn btn-primary client__order-add-product mt-3"><i
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
                    <input v-model="clientPay" id="delivery-pay-no" type="radio" name="delivery-pay" :value="false" checked>
                </div>
                <input  v-model="clientPayCost" class="form-control" name="delivery-pay-count" type="text"
                       placeholder="Какую сумму взять c клиента" :disabled="!clientPay">
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Комментарий:</h4>
                <textarea v-model="comment" class="form-control" name="delivery-comment"
                          placeholder="Комментарий к заказу"></textarea>
            </div>

<!--            <div class="client__order-row">-->
<!--                <h4 class="client__order-subtitle">Изменить статус:</h4>-->
<!--                <div class="required">-->
<!--                    <select class="form-control" name="order-status" required>-->
<!--                        <option value="not-allocated" @if($status == "not-allocated") selected @endif>Не распределен</option>-->
<!--                        <option value="pending" @if($status == "pending") selected @endif>Ожидается забор товара-->
<!--                        </option>-->
<!--                        <option value="stock" @if($status == "stock") selected @endif>Товар на складе</option>-->
<!--                        <option value="courier" @if($status == "courier") selected @endif>Товар у курьера</option>-->
<!--                        <option value="return" @if($status == "return") selected @endif>Возврат/перенос</option>-->
<!--                        <option value="finished" @if($status == "finished") selected @endif>Отгружен</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="client__order-row">-->
<!--                <h4 class="client__order-subtitle">От кого заказ:</h4>-->
<!--                <div class="required">-->
<!--                    <select class="form-control" name="order-client" required>-->

<!--                        <option @if (App\User::find($client_id)->roles->name === "admin") selected-->
<!--                            @endif value="{{ Auth::user()->id }}">От администратора-->
<!--                        </option>-->

<!--                        @foreach($clients as $client)-->
<!--                        <option @if($client_id == $client->id) selected-->
<!--                            @endif value="{{ $client->id }}">{{ $client->name }}</option>-->
<!--                        @endforeach-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="client__order-row">-->
<!--                <h4 class="client__order-subtitle">Курьер:</h4>-->
<!--                <div class="required">-->
<!--                    <select class="form-control" name="order-courier" required>-->
<!--                        @foreach($couriers as $courier)-->
<!--                        <option @if($courier_id == $courier->id) selected-->
<!--                            @endif value="{{ $courier->id }}">{{ $courier->name }} {{ $courier->courier_comment }}</option>-->
<!--                        @endforeach-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->


<!--            <div class="client__order-row">-->
<!--                <h4 class="client__order-subtitle">Тип заявки:</h4>-->
<!--                <div class="client__order-field">-->
<!--                    <label for="order-type-1">Забор</label>-->
<!--                    <input type="radio" name="order-type" id="order-type-1" value="Забор" checked>-->
<!--                </div>-->
<!--                <div class="client__order-field">-->
<!--                    <label for="order-type-2">Доставка</label>-->
<!--                    <input type="radio" name="order-type" id="order-type-2" value="Доставка">-->
<!--                </div>-->
<!--            </div>-->



<!--            -->
<!--            <div class="client__item-info d-block">-->
<!--                <div class="info">-->
<!--                    Курьер: <span>{{ $courier_id }}</span>-->
<!--                </div>-->
<!--                <div class="info">-->
<!--                    Адрес забора: <span>{{ $delivery_start }}</span>-->
<!--                </div>-->
<!--                <div class="info">-->
<!--                    Тип доставки: <span>{{ $type }}</span>-->
<!--                </div>-->
<!--                <div class="info">-->
<!--                    Дата доставки: <span>{{ $date }}</span>-->
<!--                </div>-->
<!--                <div class="info">-->
<!--                    Время доставки: <span>{{ $time }}</span>-->
<!--                </div>-->
<!--                <div class="info">-->
<!--                    Адрес доставки: <span>{{ $address }}</span>-->
<!--                </div>-->
<!--                <div class="info">-->
<!--                    ФИО клиента: <span>{{ $fullname }}</span>-->
<!--                </div>-->
<!--                <div class="info">-->
<!--                    Номер телефона:-->
<!--                    @foreach($contacts as $contact)-->
<!--                    <span>{{ $contact }}</span>-->
<!--                    @endforeach-->
<!--                </div>-->
<!--                <div class="info">-->
<!--                    Товары к доставке:-->
<!--                    @foreach($products as $product)-->
<!--                    <span>{{ $product->name }} - {{ $product->count }} шт.</span>-->
<!--                    @endforeach-->
<!--                </div>-->
<!--                <div class="info">-->
<!--                    Плата с клиента:-->
<!--                    <span>{{ isset($pay) ? 'Да - '.$pay.' руб.' : 'Нет' }}</span>-->
<!--                </div>-->
<!--                <div class="info mb-3">-->
<!--                    Комментарий к заказу:-->
<!--                    <span>{{ $comment }}</span>-->
<!--                </div>-->
<!--            </div>-->



            <button @click.prevent="serializeForm" type="submit" class="btn btn-primary">Оформить доставку</button>

<!--            <button type="submit" class="btn btn-primary"> Сохранить изменения</button>-->

        </form>
    </div>
</template>

<script>
import PhoneInput from "./form/PhoneInput";
import ProductRow from "./form/ProductRow";

export default {
    name: "CreateForm",
    components: { PhoneInput, ProductRow },
    props: {
        newOrder: {
            type: Boolean,
            default: false,
        }
    },
    methods: {
        addPhone() {
            this.phoneFields.push(1);
        },
        addProduct() {
            this.productFields.push(1);
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
                comment: this.comment
            })
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
        clientPayCount() {
          if (!this.clientPay) return this.clientPayCost = null
            return this.clientPayCost
        }
    },
    data() {
        return {
            phoneFields: [1],
            productFields: [1],
            deliveryType: "Стандарт",
            date: null,
            time: "В любое время",
            address: null,
            fullname: null,
            contacts: [],
            products: [],
            clientPay: false,
            clientPayCost: null,
            comment: "",
        }
    }
}
</script>

<style scoped>

</style>
