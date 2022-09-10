<template>
  <div
    :class="[
      'alert',
      type && `alert-${type}`
    ]"
    role="alert"
  >
    <slot />
  </div>
</template>

<script>
export default {
 name: 'VAlert',

 props: {
  type: {
    type: String,
    default: 'info'
  }
 }
}
</script>

<style>

</style>