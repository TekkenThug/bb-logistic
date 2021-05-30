<template>
    <tr>
        <td class="client__order-item-name">
            <input :value="info.name" @input="send($event, 'name')" class="form-control" required name="delivery-info" type="text"
                   placeholder="Наименование товара">
        </td>
        <td class="client__order-item-cost">
            <input :value="info.cost"  @input="send($event, 'cost')"  class="form-control" required name="delivery-info" type="text"
                   placeholder="Стоимость шт.">
        </td>
        <td class="client__order-item-count">
            <input :value="info.count"  @input="send($event, 'count')"  required class="form-control" name="delivery-info" type="number" min="1"
                   placeholder="Кол-во">
        </td>
    </tr>
</template>

<script>
export default {
    name: "ProductRow",
    props: {
        info: {
            type: Object,
            default() {
                return {
                    name: "",
                    count: 0,
                    cost: 0
                }
            }
        }
    },
    methods: {
        send(e, key) {
            this.info[key]= e.target.value;
            this.$emit('input', this.info);
        }
    }
}
</script>

<style scoped>

</style>
