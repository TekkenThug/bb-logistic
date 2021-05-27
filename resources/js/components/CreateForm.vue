<template>
    <div id="order" class="client__order client-tab active">

        <form id="client-create-order" class="client__order-form" method="POST">
            <div class="client__order-row">
                <h4 class="client__order-subtitle">Тип доставки:</h4>
                <div class="client__order-field">
                    <label for="delivery-type-1">Стандарт</label>
                    <input type="radio" name="delivery-type" id="delivery-type-1" value="Стандарт" required
                           checked>
                </div>
                <div class="client__order-field">
                    <label for="delivery-type-2">ДВД</label>
                    <input type="radio" name="delivery-type" id="delivery-type-2" required value="ДВД">
                </div>
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Дата доставки:</h4>
                <input class="form-control" name="delivery-date" type="date" min="" required>
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Время доставки:</h4>
                <select class="form-control" name="delivery-interval" required>
                    <option value="В любое время" selected>В любое время</option>
                    <option value="10.00 - 14.00">10.00 - 14.00</option>
                    <option value="14.00 - 18.00">14.00 - 18.00</option>
                    <option value="18.00 - 22.00">18.00 - 22.00</option>
                </select>
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Адрес доставки:</h4>
                <input class="form-control" type="text" name="delivery-address" required
                       placeholder="Адрес доставки">
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">ФИО:</h4>
                <input class="form-control" type="text" name="delivery-fullname" required
                       placeholder="Введите ФИО клиента">
            </div>

            <div class="client__order-row">
                <h4 class="client__order-subtitle">Контакты:</h4>
                <div class="fields-list">
                    <input class="form-control" type="text" name="delivery-phone[]" required
                           placeholder="+7 (999) 999-99-99">
                </div>
                <button class="btn btn-primary client__order-add-number mt-3"><i class="fas fa-plus"></i>
                    Добавить номер
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
                                <input class="form-control" required name="delivery-info[0][]" type="number" min="1"
                                       placeholder="Кол-во">
                            </td>
                        </tr>
                    </table>
                    <button type="button" class="btn btn-primary client__order-add-product mt-3"><i
                        class="fas fa-plus"></i> Добавить товар
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
                <input class="form-control" type="text" name="delivery-pay-count"
                       placeholder="Какую сумму взять c клиента" disabled>
            </div>

            <div class="client__order-row ">
                <h4 class="client__order-subtitle">Комментарий:</h4>
                <textarea class="form-control" name="delivery-comment"
                          placeholder="Комментарий к заказу"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Оформить доставку</button>
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
