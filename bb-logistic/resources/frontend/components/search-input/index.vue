<template>
  <div class="admin-client-list__search">
    <input
      class="form-control"
      type="text"
      :value="value"
      :placeholder="placeholder"
      @input="$emit('input', $event.target.value)"
    >
  </div>
</template>

<script>
export default {
    name: 'SearchInput',
    props: {
        value: '',
        placeholder: {
            type: String,
            default: 'Поиск'
        }
    },
};
</script>