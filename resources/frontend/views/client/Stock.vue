<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2 fulfillment">
            <div class="fulfillment__stock">
                <h2>Складские остатки</h2>

                <UIPreloader v-if="isLoading" />

                <h3 v-else-if="!tableData.length">
                    На складе отсутствует товар
                </h3>

                <stock-table
                    v-else
                    :operation="false"
                    :headers="tableHeaders"
                    :data="tableData"
                />
            </div>
        </div>
    </div>
</template>

<script>
import { getStockProducts } from "@/services/api/stock";

import StockTable from "@/components/stock-table";

export default {
    name: "Stock",
    components: {StockTable},
    data() {
        return {
            tableHeaders: ['№', 'Название', 'Цвет', 'Размер', 'Артикул', 'Шт.'],
            tableData: [],
            isLoading: true,
        }
    },
    async created() {
        this.tableData = await this.getItems(this.$store.state.user?.id);
        this.isLoading = false;
    },
    methods: {
        async getItems(id) {
            const { data } = await getStockProducts(id);
            return data.stock;
        },
    }
}
</script>

<style scoped>
.fulfillment {
    padding-top: 80px;
}
</style>
