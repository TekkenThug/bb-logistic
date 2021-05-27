<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div id="open-orders" class="client__list client-tab active">
                <OrderRow />
            </div>
        </div>
    </div>
</template>

<script>
import OrderRow from "../../components/OrderRow";

export default {
    name: "OpenOrders",
    components: { OrderRow }
}
</script>

<style scoped>

</style>
