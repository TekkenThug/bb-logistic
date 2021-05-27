<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="admin-orders overall">
                <h4>Список заявок:</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <SearchInput class="flex-grow-1" style="margin-right: 10px" placeholder="Поиск по номеру заявки..." />
                    <a href="" style="width: 200px" class="flex-shrink-0 btn btn-primary">Создать
                        новую заявку</a>
                </div>
                <div class="admin-client__filter">
                    <select class="form-select" id="order-filter">
                        <option class="btn-filter" value="all" selected>Выберите фильтр</option>
                        <option class="btn-filter" value="not-allocated">Не распределено</option>
                        <option class="btn-filter" value="pending">Ожидается забор товара</option>
                        <option class="btn-filter" value="stock">Товар на складе</option>
                        <option class="btn-filter" value="courier">Товар у курьера</option>
                        <option class="btn-filter" value="return">Возврат/перенос</option>
                        <option class="btn-filter" value="finished">Отгружен</option>
                    </select>
                </div>
                <div class="admin__client-list">
                    <OrderRow />
                </div>
            </div>
<!--            {{ $orders->links() }}-->
        </div>
    </div>
</template>

<script>
import OrderRow from "../../components/OrderRow";
import SearchInput from "../../components/SearchInput";
export default {
    name: "OrderList",
    components: {SearchInput, OrderRow}
}
</script>

<style scoped>

</style>
