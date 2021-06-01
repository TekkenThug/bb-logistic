<template>
    <router-link :to="{ path: path + id}" v-if="role === 'client'" class="admin-client-list__item">
        <h4>{{ name }} <span>{{ email }}</span></h4>
        <span>Aдрес забора: {{ address }}</span>
    </router-link>

    <router-link :to="{ path: path + id}" v-else-if="role === 'courier'" class="admin-client-list__item">
        <h4>{{ name }} <span>{{ comment }}</span></h4>
        <span>{{ email }} {{ phone }}</span>
    </router-link>
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
        },
        phone: {
            type: String,
            default: ""
        },
        comment: {
            type: String,
            default: "",
        },
        role: {
            type: String,
            default: ""
        },
        path: {
            type: String,
            default: ""
        },
        id: {
            type: Number,
            default: 0
        }
    }
}
</script>

<style scoped>

</style>
