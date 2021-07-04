<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2 fulfillment">
            <div class="fulfillment__stock">
                <h2>Складские остатки</h2>
                <select-field v-model="selectUser"
                              :data-array="users"
                              data-view="name"
                              data-property="id">
                    Выберите пользователя
                </select-field>
                <stock-table v-show="tableData.length && !preloader"
                             :headers="tableHeaders"
                             :data="tableData"
                             @itemHandlerDelete="deleteItem"
                >
                    <template v-slot:after>
                        <add-form ref="addForm" @serialize="createProduct"/>
                    </template>
                </stock-table>
                <preloader v-if="preloader"/>
            </div>
        </div>
    </div>
</template>

<script>
import SelectField from "../../components/new/SelectField";
import StockTable from "../../components/new/StockTable";
import AddForm from "../../components/fulfillment/AddForm";

export default {
    name: "Fulfillment",
    components: {SelectField, StockTable, AddForm},
    data() {
        return {
            selectUser: null,
            users: [],
            preloader: false,
            tableHeaders: ['№', 'ID', 'Название', 'Цвет', 'Размер', 'Артикул', 'Шт.', 'Штрихкод', 'Операции'],
            tableData: []
        }
    },
    mounted() {
        /* Получение списка клиентов */
        this.$load(async () => {
            this.users = await this.$api.common.getClients()
        });
    },
    watch: {
        /* Слежение за изменением клиента */
        selectUser(id) {
            this.preloader = true;
            this.$load(async () => {
                this.tableData = await this.getItems(id);
                this.preloader = false
            })
        }
    },
    methods: {
        /* Получение продуктов */
        getItems(id) {
            return this.$api.stock.getProducts(id)
        },

        /* Удаление продукта */
        deleteItem(id) {
            this.$load(async () => {
                this.preloader = true;
                await this.$api.stock.deleteProducts(id);
                this.tableData = await this.getItems(this.selectUser);
                this.preloader = false;
            });
        },

        /* Создание продукта */
        createProduct(data) {
            this.$load(async () => {
                this.preloader = true;

                const res = await this.$api.stock.createProduct(this.selectUser, data);
                this.tableData = await this.getItems(this.selectUser);
                if (res === 'success') this.$refs.addForm.clear();

                this.preloader = false;
            });

        }
    }
}
</script>

<style scoped>
.fulfillment {
    padding-top: 80px;
}
</style>
