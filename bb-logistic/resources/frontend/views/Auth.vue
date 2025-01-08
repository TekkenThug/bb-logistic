<template>
    <div :class="$style.Auth">
        <ThemeToggle :class="$style.themeToggle" />

        <form
            :class="$style.form"
            @submit.prevent="sendLoginDataToServer"
        >
            <div>
                <Input v-model="loginCredentials.email" placeholder="Email" />
            </div>

            <div>
                <Input v-model="loginCredentials.password" type="password" placeholder="Пароль" />
            </div>

            <div
                v-if="isError"
                :class="$style.error"
            >
                Пожалуйста, проверьте введенные данные.
            </div>

            <button type="submit">
                Войти
            </button>

            <UILoader v-if="isLoading" />
        </form>
    </div>
</template>

<script setup>
import { login, getCSRF } from '@/services/api/auth';

import { Input } from "@/components/ui/input";
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useUserStore } from "@/store/user";
import ThemeToggle from "@/components/common/theme-toggle/ThemeToggle";

const router = useRouter();
const { user, role } = useUserStore();

const loginCredentials = ref({ email: null, password: null });
const isError = ref(false);
const isLoading = ref(false);

const sendLoginDataToServer = async () => {
    isLoading.value = true;
    isError.value = false;

    try {
        const { data } = await login(loginCredentials.value);

        user.value = { role: data.role };

        await router.push(`/${data.role}`);
    } catch (_) {
        isError.value = true;
    } finally {
        isLoading.value = false;
    }
};

onMounted(async () => {
    await getCSRF();
});
</script>

<style lang="scss" module>
.Auth {
    position: relative;
    width: 100vw;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
}

.themeToggle {
    position: absolute;
    right: 10px;
    top: 10px;
}

.form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 24px;
    padding: 24px;
    border: 2px solid transparent;
    border-radius: 12px;
    box-shadow: $blue-400 0 7px 29px 0;
}

.error {
    text-align: center;
    color: red;
    max-width: 140px;
    font-size: 14px;
}
</style>
