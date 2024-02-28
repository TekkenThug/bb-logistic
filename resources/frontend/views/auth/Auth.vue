<template>
    <div :class="$style.Auth">
        <!-- <img class="login-form__img" src="/images/logo.png" alt="bandb"> -->
        <form
            :class="$style.form"
            @submit.prevent="sendLoginDataToServer"
        >
            <div>
                <UIIcon name="user" />

                <input
                    v-model="email"
                    type="text"
                    name="email"
                    class="form-control"
                    placeholder="Логин"
                    required
                />
            </div>

            <div>
                <UIIcon name="lock" />

                <input
                    v-model="password"
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Пароль"
                    required
                />
            </div>

            <div
                v-if="error"
                class="error"
                role="alert"
            >
                Пожалуйста, проверьте введенные данные.
            </div>

            <button
                type="submit"
                class="btn btn-primary mt-2"
            >
                Войти
            </button>

            <UILoader
                v-if="isLoading"
                class="mt-2"
            />
        </form>
    </div>
</template>

<script setup>
import { login, getCSRF } from '@/services/api/auth';

import UIIcon from "@/components/UI/icon/UIIcon";
import { reactive, ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';

const loginCrenedtials = reactive({ email: null, password: null });

const isError = ref(false);
const isLoading = ref(false);

onMounted(async () => {
    await getCSRF();
});

const store = useStore();
const router = useRouter();

const sendLoginDataToServer = async () => {
    isLoading.value = true;
    isError.value = false;

    try {
        const data = await login(loginCrenedtials.value);

        // this.$store.commit('setUser', { token, role });

        store.commit('setUser', { role: data.role });

        const userRole = store.getters.userRole;
        const redirectPath = userRole === 'admin' ? '/admin' :
        userRole === 'courier' ? '/courier' :
        userRole === 'client' ? '/client' : '/';

        this.$router.push(redirectPath);
    } catch (e) {
        isError.value = true;
    } finally {
        isLoading.value = false;
    }
};
</script>

<style lang="scss" module>
.Auth {
    width: 100vw;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
}

.form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding: 16px;
    max-width: 380px;
    border: 3px solid $primary-100;
    border-radius: 10px;
}

.error {
    text-align: center;
    color: red;
    margin: 15px 0;
    max-width: 220px;
}
</style>
