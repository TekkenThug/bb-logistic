<template>
    <div class="admin-client-list__search">
        <input class="form-control" type="text" :placeholder="placeholder">
    </div>
</template>

<script>
export default {
    name: "SearchInput",
    props: {
        placeholder: {
            type: String,
            default: "Поиск"
        }
    }
}
</script>

<style scoped>

</style>
