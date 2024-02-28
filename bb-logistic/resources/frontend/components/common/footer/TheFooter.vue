<template>
    <footer :class="$style.TheFooter">
        <div
            v-html="text"
            :class="$style.text"
        />
    </footer>
</template>

<script setup>
import { computed } from "vue";

const text = computed(() => {
    if (import.meta.env.MODE === "production") {
        const email = import.meta.env.VITE_SUPPORT_EMAIL;

        return `
            Система находится в тестовом режиме.
            В случае неполадок, просьба обратиться - <a href="mailto:${email}">${email}</a>
        `
    }

    return `Система запущена в dev режиме. Версия приложения - ${window.__APP_VERSION__}`
});
</script>

<style lang="scss" module>
    .TheFooter {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: $primary-100;
        color: #ffffff;
        padding: 15px;

        @include respond($mobile) {
            padding: 10px;
        }
    }

    .text {
        font-weight: 700;
        text-align: center;

        @include respond($mobile) {
            font-size: 12px;
        }
    }
</style>
