<template>
    <div class="client__order client-tab active">
        <form method="POST"  class="client__order-form">

            <h4 class="admin-create__form-title">Создание заявки</h4>
            <h4 class="admin-create__form-title">Изменить заявку</h4>


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
                    <input required type="radio" name="delivery-type" id="delivery-type-1" value="Стандарт" checked>
                </div>
                <div class="client__order-field">
                    <label for="delivery-type-2">ДВД</label>
                    <input required type="radio" name="delivery-type" id="delivery-type-2" value="ДВД">
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
<!--                    <input required class="form-control" name="delivery-date" type="date" min="{{ date('Y-m-d') }}">-->
                </div>
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Время доставки:</h4>
                <div class="required">
                    <select required class="form-control" name="delivery-interval">
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
                    <input required class="form-control" type="text" name="delivery-address"
                           placeholder="Адрес доставки">
                </div>
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">ФИО:</h4>
                <div class="required">
                    <input required class="form-control" type="text" name="delivery-fullname"
                           placeholder="Введите ФИО клиента">
                </div>
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Контакты:</h4>
                <div class="fields-list required">
                    <input required class="form-control" type="text" name="delivery-phone[]"
                           placeholder="+7 (999) 999-99-99">
                </div>
                <button class="btn btn-primary client__order-add-number mt-3"><i class="fas fa-plus"></i> Добавить номер
                </button>
            </div>

            <div class="client__order-row width">
                <h4 class="client__order-subtitle">Товары к доставке:</h4>
                <div class="client__order-list-wrap">
                    <table class="client__order-list">
                        <tr>
                            <td class="client__order-item-name">
                                <input class="form-control" required name="delivery-info[0][]" type="text"
                                       placeholder="Наименование товара">
                            </td>
                            <td class="client__order-item-cost">
                                <input class="form-control" required name="delivery-info[0][]" type="text"
                                       placeholder="Стоимость шт.">
                            </td>
                            <td class="client__order-item-count">
                                <input required class="form-control" name="delivery-info[0][]" type="number" min="1"
                                       placeholder="Кол-во">
                            </td>
                        </tr>
                    </table>
                    <button type="button" class="btn btn-primary client__order-add-product mt-3"><i
                        class="fas fa-plus"></i>
                        Добавить товар
                    </button>
                </div>
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Оплата с клиента:</h4>
                <div class="client__order-field">
                    <label for="delivery-pay-yes">Да</label>
                    <input id="delivery-pay-yes" type="radio" name="delivery-pay" value="yes">
                </div>
                <div class="client__order-field">
                    <label for="delivery-pay-no">Нет</label>
                    <input id="delivery-pay-no" type="radio" name="delivery-pay" value="no" checked>
                </div>
                <input class="form-control" name="delivery-pay-count" type="text"
                       placeholder="Какую сумму взять c клиента" disabled>
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Комментарий:</h4>
                <textarea class="form-control" name="delivery-comment"
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
<!--                <h4 class="client__order-subtitle">Тип доставки:</h4>-->
<!--                <div class="client__order-field">-->
<!--                    <label for="delivery-type-1">Стандарт</label>-->
<!--                    <input @if($type === "Стандарт") checked @endif type="radio"-->
<!--                    name="delivery-type" id="delivery-type-1" value="Стандарт" required>-->
<!--                </div>-->
<!--                <div class="client__order-field">-->
<!--                    <label for="delivery-type-2">ДВД</label>-->
<!--                    <input @if($type === "ДВД") checked @endif type="radio" name="delivery-type"-->
<!--                    id="delivery-type-2" required value="ДВД">-->
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

<!--            <div class="client__order-row">-->
<!--                <h4 class="client__order-subtitle">Дата доставки:</h4>-->
<!--                <div class="required">-->
<!--                    <input required value="{{ $date }}" class="form-control" name="delivery-date" type="date"-->
<!--                           min="{{ date('Y-m-d') }}">-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="client__order-row">-->
<!--                <h4 class="client__order-subtitle">Время доставки:</h4>-->
<!--                <div class="required">-->
<!--                    <select required class="form-control" name="delivery-interval">-->
<!--                        <option @if($time == "В любое  время") selected-->
<!--                        @endif value="В любое время">В любое время-->
<!--                        </option>-->
<!--                        <option @if($time == "10.00 - 14.00") selected @endif value="10.00 - 14.00">-->
<!--                        10.00 - 14.00-->
<!--                        </option>-->
<!--                        <option @if($time == "14.00 - 18.00") selected @endif value="14.00 - 18.00">-->
<!--                        14.00 - 18.00-->
<!--                        </option>-->
<!--                        <option @if($time == "18.00 - 22.00") selected @endif value="18.00 - 22.00">-->
<!--                        18.00 - 22.00-->
<!--                        </option>-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="client__order-row">-->
<!--                <h4 class="client__order-subtitle">Адрес доставки:</h4>-->
<!--                <div class="required">-->
<!--                    <input required value="{{ $address }}" class="form-control" type="text" name="delivery-address"-->
<!--                           placeholder="Адрес доставки">-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="client__order-row">-->
<!--                <h4 class="client__order-subtitle">ФИО:</h4>-->
<!--                <div class="required">-->
<!--                    <input required value="{{ $fullname }}" class="form-control" type="text" name="delivery-fullname"-->
<!--                           placeholder="Введите ФИО клиента">-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="client__order-row">-->
<!--                <h4 class="client__order-subtitle">Контакты:</h4>-->
<!--                <div class="fields-list">-->

<!--                    @for($i = 0 ; $i < count($contacts) - 1; $i++)-->
<!--                    <div class="required">-->
<!--                        <input value="{{$contacts[$i]}}" class="form-control" type="text" name="delivery-phone[]"-->
<!--                               required-->
<!--                               placeholder="+7 (999) 999-99-99">-->
<!--                    </div>-->
<!--                    @endfor-->
<!--                </div>-->
<!--                <button class="btn btn-primary client__order-add-number mt-3"><i class="fas fa-plus"></i> Добавить номер-->
<!--                </button>-->
<!--            </div>-->

<!--            <div class="client__order-row width">-->
<!--                <h4 class="client__order-subtitle">Товары к доставке:</h4>-->
<!--                <div class="client__order-list-wrap">-->
<!--                    <table class="client__order-list">-->
<!--                        @foreach($products as $index => $product)-->
<!--                        <tr>-->
<!--                            <td class="client__order-item-name">-->
<!--                                <input value="{{ $product->name }}" class="form-control" required-->
<!--                                       name="delivery-info[{{$index}}][]" type="text"-->
<!--                                       placeholder="Наименование товара">-->
<!--                            </td>-->
<!--                            <td class="client__order-item-cost">-->
<!--                                <input value="{{ $product->cost }}" class="form-control" required-->
<!--                                       name="delivery-info[{{$index}}][]" type="text"-->
<!--                                       placeholder="Стоимость шт.">-->
<!--                            </td>-->
<!--                            <td class="client__order-item-count">-->
<!--                                <input value="{{ $product->count }}" class="form-control" required-->
<!--                                       name="delivery-info[{{$index}}][]" type="number" min="1"-->
<!--                                       placeholder="Кол-во">-->
<!--                            </td>-->
<!--                        </tr>-->
<!--                        @endforeach-->
<!--                    </table>-->
<!--                    <button type="button" class="btn btn-primary client__order-add-product mt-3"><i-->
<!--                        class="fas fa-plus"></i>-->
<!--                        Добавить товар-->
<!--                    </button>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="client__order-row">-->
<!--                <h4 class="client__order-subtitle">Оплата с клиента:</h4>-->
<!--                <div class="client__order-field">-->
<!--                    <label for="delivery-pay-yes">Да</label>-->
<!--                    <input @if(!$order->delivery_pay == null) checked @endif id="delivery-pay-yes" type="radio"-->
<!--                    name="delivery-pay" value="yes">-->
<!--                </div>-->
<!--                <div class="client__order-field">-->
<!--                    <label for="delivery-pay-no">Нет</label>-->
<!--                    <input @if($order->delivery_pay == null) checked @endif id="delivery-pay-no" type="radio"-->
<!--                    name="delivery-pay" value="no">-->
<!--                </div>-->
<!--                <input class="form-control" type="text" name="delivery-pay-count"-->
<!--                       placeholder="Какую сумму взять c клиента" @if($order->delivery_pay == null) disabled-->
<!--                @else value="{{$order->delivery_pay}}" @endif>-->
<!--            </div>-->

<!--            <div class="client__order-row">-->
<!--                <h4 class="client__order-subtitle">Комментарий:</h4>-->
<!--                <textarea class="form-control" name="delivery-comment"-->
<!--                          placeholder="Комментарий к заказу">{{ $order->delivery_comment }}</textarea>-->
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



            <button type="submit" class="btn btn-primary">Оформить доставку</button>

<!--            <button type="submit" class="btn btn-primary"> Сохранить изменения</button>-->

        </form>
    </div>
</template>

<script>
export default {
    name: "CreateForm"
}
</script>

<style scoped>

</style>
