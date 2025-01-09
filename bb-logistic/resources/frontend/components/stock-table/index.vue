<template>
  <div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th
            v-for="head in headers"
            scope="col"
          >
            {{ head }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(dataItem, index) in data"
          :key="index"
        >
          <th scope="row">
            {{ index + 1 }}
          </th>
          <td
            v-for="(dataField, index) in dataItem"
            :key="index"
          >
            <img
              v-if="index === 'barcodeImg'"
              :src="dataField"
              alt=""
            >
            <span v-else>{{ dataField }}</span>
          </td>
          <td v-if="operation">
            <small-btn
              icon="fas fa-edit"
              @click="$emit('itemHandlerUpdate', dataItem)"
            />
            <small-btn
              icon="far fa-trash-alt"
              @click="$emit('itemHandlerDelete', dataItem['id'])"
            />
          </td>
        </tr>
      </tbody>
    </table>
    <slot name="after" />
  </div>
</template>

<script>
import SmallBtn from "./components/SmallBtn";

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
