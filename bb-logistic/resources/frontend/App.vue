<template>
  <div>
    <RouterView />
  </div>
</template>

<script setup>
import { watch, onBeforeMount } from "vue";
import { useRouter } from 'vue-router';
import { getCSRF, me } from "@/services/api/auth";

import { useAppStore } from "@/store/app";
import { useUserStore } from "@/store/user"

const router = useRouter();
const appStore = useAppStore();
const userStore = useUserStore();

watch(() => appStore.theme, (value) => {
    const body = document.querySelector("body");

    body.dataset.theme = value;
}, {
    immediate: true,
});

onBeforeMount(async () => {
    await getCSRF();

    try {
        const { data } = await me();

        userStore.setupUser(data);

        await router.push({ path: `/${userStore.role}` });
    } catch (error) {
        console.log("Error")
    }
});
</script>
