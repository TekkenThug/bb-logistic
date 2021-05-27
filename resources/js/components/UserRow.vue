<template>
    <a class="admin-client-list__item" href="">
        <h4>{{ name }} <span>{{ email }}</span></h4>
        <span>Aдрес забора: {{ address }}</span>
    </a>
</template>

<script>
export default {
    name: "UserRow",
    props: {
        name: {
            type: String,
            default: "User",
        },
        email: {
            type: String,
            default: "mail@mail.ru"
        },
        address: {
            type: String,
            default: "г. Москва"
        }
    }
}
</script>

<style scoped>

</style>
