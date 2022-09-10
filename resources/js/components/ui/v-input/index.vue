<template>
  <div class="v-input">
    <h3 v-if="label">
      {{ label }}
    </h3>

    <input
      class="form-control"
      :type="type"
      :value="value"
      :required="required"
      :placeholder="placeholder"
      @change="$emit(event.target.value)"
    />
  </div>
</template>

<script>
export default {
  name: 'VInput',

  props: {
    label: {
      type: String,
      default: ''
    },

    value: {
      type: [String, Number],
      default: ''
    },

    placeholder: {
      type: [String, Number],
      default: ''
    },

    type: {
      type: String,
      default: 'text'
    },

    required: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style>

</style>