<template>
    <button @click="$emit('click', $event)" class="btn btn-primary">
        <i :class="icon"></i>
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
