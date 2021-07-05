<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2 fulfillment">
            <div class="fulfillment__stock">
                <h2>Складские остатки</h2>
                <stock-table v-show="tableData.length && !preloader"
                             :operation="false"
                             :headers="tableHeaders"
                             :data="tableData"
                >
                </stock-table>
                <h3 v-show="tableData.length < 1 && !preloader">На складе отсутствует товар</h3>
                <preloader v-if="preloader"/>
            </div>
        </div>
    </div>
</template>

<script>
import StockTable from "../../components/new/StockTable";

export default {
    name: "Stock",
    components: {StockTable},
    data() {
        return {
            tableHeaders: ['№', 'Название', 'Цвет', 'Размер', 'Артикул', 'Шт.'],
            tableData: [],
            preloader: true,
        }
    },
    created() {
        this.$load(async () => {
            this.tableData = await this.getItems(this.$auth.user().id)
            this.preloader = false
        })
    },
    methods: {
        getItems(id) {
            return this.$api.stock.getProducts(id)
        },
    }
}
</script>

<style scoped>
.fulfillment {
    padding-top: 80px;
}
</style>
