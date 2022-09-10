<template>
  <form @submit.prevent="$emit('submit')" class="admin-create__form">
    <h3 v-if="title" class="admin-create__form-title">
      {{ title }}
    </h3>

    <div class="admin-create__form-inner">
      <slot />
    </div>
  </form>
</template>

<script>
export default {
  name: 'LayoutForm',

  props: {
    title: {
      type: String,
      default: ''
    }
  }
}
</script>

<style>

</style>