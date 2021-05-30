<template>
    <div class="admin-client__filter">
        <select :value="filter" @input="$emit('input', $event.target.value)" class="form-select" id="order-filter">
            <option class="btn-filter" value="" selected>Выберите фильтр</option>
            <option class="btn-filter" value="not-allocated">Не распределено</option>
            <option class="btn-filter" value="pending">Ожидается забор товара</option>
            <option class="btn-filter" value="stock">Товар на складе</option>
            <option class="btn-filter" value="courier">Товар у курьера</option>
            <option class="btn-filter" value="return">Возврат/перенос</option>
            <option class="btn-filter" value="finished">Отгружен</option>
        </select>
    </div>
</template>

<script>
export default {
    name: "SelectFilter",
    props: {
        filter: "all"
    }
}
</script>

<style scoped>

</style>
