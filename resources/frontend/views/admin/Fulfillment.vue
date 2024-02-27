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
                             @itemHandlerUpdate="popupLogic"
                             @itemHandlerDelete="deleteItem"
                >
                    <template v-slot:after>
                        <add-form ref="addForm" @serialize="createProduct"/>
                    </template>
                </stock-table>
                <h3 v-show="tableData.length < 1 && selectUser && !preloader">На складе отсутствует товар</h3>
                <preloader v-if="preloader"/>

                <popup @serverEvent="updateProduct" @close="popup.show = false" v-if="popup.show">
                    <template v-slot:header>
                        Редактирование товара
                    </template>
                    <template v-slot:body>
                        <div v-for="(field, name) in popup.data" v-if="name !== 'id'" class="form-group">
                            <label>{{ name | translate }}</label>
                            <input class="form-control" type="text" v-model="popup.data[name]">
                        </div>
                    </template>
                </popup>
            </div>
        </div>
    </div>
</template>

<script>
import SelectField from "@/components/select-field";
import StockTable from "@/components/stock-table";
import AddForm from "@/components/fulfillment/AddForm";

export default {
    name: "Fulfillment",
    components: {SelectField, StockTable, AddForm},
    data() {
        return {
            selectUser: null,
            users: [],
            preloader: false,
            tableHeaders: ['№', 'ID', 'Название', 'Цвет', 'Размер', 'Артикул', 'Штрихкод', 'Шт.', 'Операции'],
            tableData: [],
            popup: {
                show: false,
                data: null
            }
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
        },

        /* Обновление продукта */
        updateProduct() {
            this.$load(async () => {
                this.popup.show = false;
                this.preloader = true;
                const res = await this.$api.stock.updateProduct(this.popup.data, this.popup.data['id']);
                this.tableData = await this.getItems(this.selectUser);
                this.preloader = false;
                this.popup.data = {};
            })
        },

        /* Открытие модалки по редактированию продукта */
        popupLogic(data) {
            this.popup.show = true;
            this.popup.data = Object.assign({}, data);
        }
    },

    filters: {
        translate(value) {
            if (value === 'name') return 'Имя'
            if (value === 'color') return 'Цвет'
            if (value === 'size') return 'Размер'
            if (value === 'vendor_code') return 'Артикул'
            if (value === 'count') return 'Шт.'
            if (value === 'barcode') return 'Штрихкод'
            else return 0
        }
    }
}
</script>

<style scoped>
.fulfillment {
    padding-top: 80px;
}

.form-group {
    margin-bottom: 10px;
}
</style>
