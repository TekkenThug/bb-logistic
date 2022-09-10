<template>
  <button
    :class="[
      'btn',
      'btn-primary',
      {
        'w-100': fullSized
      }
    ]"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>

<script>
export default {
  name: 'VButton',

  props: {
    fullSized: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style>

</style>