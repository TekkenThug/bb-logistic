<template>
    <form @submit.prevent>
        <div class="form-row">
            <div class="form-group">
                <input v-model="formData.name" type="text" class="form-control" placeholder="Название">
            </div>
            <div class="form-group">
                <input v-model="formData.barcode" type="text" class="form-control" placeholder="Штрихкод">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <input v-model="formData.vendorCode" type="text" class="form-control" placeholder="Артикул">
            </div>
            <div class="form-group">
                <input v-model="formData.color" type="text" class="form-control" placeholder="Цвет">
            </div>
            <div class="form-group">
                <input v-model="formData.size" type="text" class="form-control" placeholder="Размер">
            </div>
            <div class="form-group">
                <input v-model="formData.count" type="number" class="form-control" placeholder="Шт.">
            </div>
        </div>

        <button @click.prevent="$emit('serialize', formData)" class="w-100 btn btn-primary">Создать</button>
    </form>
</template>

<script>
export default {
    name: "AddForm",
    data() {
        return {
            formData: {
                name: null,
                vendorCode: null,
                color: null,
                size: null,
                count: null,
                barcode: null
            }
        }
    },
    methods: {
        clear() {
            this.formData = {
                name: null,
                vendorCode: null,
                color: null,
                size: null,
                count: null,
                barcode: null
            }
        }
    }
}
</script>

<style scoped>
.form-row {
    display: flex;
    justify-content: space-between;
    margin: 0 -10px;
}

.form-group {
    flex-grow: 1;
    margin: 20px 10px;
}

@media (max-width: 576px) {
    .form-row {
        flex-wrap: wrap;
    }
}
</style>
