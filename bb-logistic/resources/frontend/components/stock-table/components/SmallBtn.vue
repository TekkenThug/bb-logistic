<template>
  <button
    class="btn btn-primary"
    @click="$emit('click', $event)"
  >
    <i :class="icon" />
  </button>
</template>

<script>
export default {
    name: "SmallBtn",
    props: {
        icon: {
            type: String,
            default: null
        }
    }
}
</script>

<style scoped>
    button {
        width: 30px;
        height: 30px;
        padding: 0;
        font-size: 100%;
    }
</style>
