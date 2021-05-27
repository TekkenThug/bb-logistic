<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div id="order-list" class="client__list client-tab">
                <h2 class="text-center">Заявок нет</h2>
                <OrderRow />
            </div>
        </div>
    </div>
</template>

<script>
import OrderRow from "../../components/OrderRow";

export default {
    name: "OrderList",
    components: { OrderRow }
}
</script>

<style scoped>

</style>
