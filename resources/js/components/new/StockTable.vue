<template>
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th v-for="head in headers" scope="col">{{ head }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(dataItem, index) in data" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td v-for="(dataField, index) in dataItem" :key="index">
                    <img v-if="index === 'barcodeImg'" :src="dataField" alt="">
                    <span v-else>{{ dataField }}</span>
                </td>
                <td v-if="operation">
                    <small-btn @click="$emit('itemHandlerUpdate', dataItem)" icon="fas fa-edit" />
                    <small-btn @click="$emit('itemHandlerDelete', dataItem['id'])" icon="far fa-trash-alt" />
                </td>
            </tr>
            </tbody>
        </table>
        <slot name="after">
        </slot>
    </div>

</template>

<script>
import SmallBtn from "../../components/new/SmallBtn";

export default {
    name: "StockTable",
    components: {SmallBtn},
    props: {
        headers: {
            type: Array
        },
        data: {
            type: Array
        },
        operation: {
          type: Boolean,
          default: true
        },
        edit: {
            type: Boolean,
            default: false,
        }
    }
}
</script>

<style scoped>

</style>
