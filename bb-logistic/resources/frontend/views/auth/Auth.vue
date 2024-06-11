<template>
    <div :class="$style.Auth">
        <ThemeToggle :class="$style.themeToggle" />

        <form
            :class="$style.form"
            @submit.prevent="sendLoginDataToServer"
        >
            <div>
                <UIIcon name="user" />

                <input
                    v-model="loginCredentials.email"
                    type="text"
                    name="email"
                    class="form-control"
                    placeholder="Email"
                    required
                />
            </div>

            <div>
                <UIIcon name="lock" />

                <input
                    v-model="loginCredentials.password"
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Пароль"
                    required
                />
            </div>

            <div
                v-if="isError"
                class="error"
                role="alert"
            >
                Пожалуйста, проверьте введенные данные.
            </div>

            <button
                type="submit"
                class="btn btn-primary mt-2"
            >
                Sign in
            </button>

            <UILoader v-if="isLoading" />
        </form>
    </div>
</template>

<script setup>
import { login, getCSRF } from '@/services/api/auth';

import UIIcon from "@/components/UI/icon/UIIcon";
import { reactive, ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useUserStore } from "@/store/user";
import ThemeToggle from "../../components/common/theme-toggle/ThemeToggle.vue";

const loginCredentials = reactive({ email: null, password: null });

const isError = ref(false);
const isLoading = ref(false);

onMounted(async () => {
    await getCSRF();
});

const router = useRouter();
const { user, role } = useUserStore();

const sendLoginDataToServer = async () => {
    isLoading.value = true;
    isError.value = false;

    try {
        const data = await login(loginCredentials.value);

        user.value = { role: data.role };

        const redirectPath = role === 'admin' ? '/admin' :
        role === 'courier' ? '/courier' :
        role === 'client' ? '/client' : '/';

        await router.push(redirectPath);
    } catch (e) {
        isError.value = true;
    } finally {
        isLoading.value = false;
    }
};
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
    padding: 24px;
    border: 2px solid transparent;
    border-radius: 12px;
    box-shadow: $blue-400 0 7px 29px 0;
}

.error {
    text-align: center;
    color: red;
    margin: 15px 0;
    max-width: 220px;
}
</style>
