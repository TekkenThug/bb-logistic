<template>
    <div>
        <RouterView />
    </div>
</template>

<script setup>
import { useAppStore } from "@/store/app";
import "@/assets/styles/global.scss";
import { watch } from "vue";

const appStore = useAppStore();

watch(() => appStore.theme, (value) => {
    const body = document.querySelector("body");

    body.dataset.theme = value;
}, {
    immediate: true,
});
</script>
