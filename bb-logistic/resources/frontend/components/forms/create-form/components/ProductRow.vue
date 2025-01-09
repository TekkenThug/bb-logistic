<template>
  <tr>
    <td class="client__order-item-name">
      <input
        :value="info.name"
        class="form-control"
        required
        name="delivery-info"
        type="text"
        placeholder="Наименование товара"
        @input="send($event, 'name')"
      >
    </td>
    <td class="client__order-item-cost">
      <input
        :value="info.cost"
        class="form-control"
        required
        name="delivery-info"
        type="text"
        placeholder="Стоимость шт."
        @input="send($event, 'cost')"
      >
    </td>
    <td class="client__order-item-count">
      <input
        :value="info.count"
        required
        class="form-control"
        name="delivery-info"
        type="number"
        min="1"
        placeholder="Кол-во"
        @input="send($event, 'count')"
      >
    </td>
  </tr>
</template>

<script>
export default {
    name: 'ProductRow',
    props: {
        info: {
            type: Object,
            default() {
                return {
                    name: '',
                    count: 0,
                    cost: 0
                };
            }
        }
    },
    methods: {
        send(e, key) {
            this.info[key]= e.target.value;
            this.$emit('input', this.info);
        }
    }
};
</script>
