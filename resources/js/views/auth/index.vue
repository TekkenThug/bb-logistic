<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="login-form-wrapper">
                    <img class="login-form__img" src="/images/logo.png" alt="bandb">
                    <form class="login-form" method="POST" @submit.prevent="sendLoginDataToServer" >
                        <div class="form-group login">
                            <input
                                v-model="email"
                                type="text"
                                name="email"
                                class="form-control"
                                placeholder="Логин"
                                required
                            />
                        </div>

                        <div class="form-group password">
                            <input
                                v-model="password"
                                type="password"
                                name="password" class="form-control"
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

                        <button type="submit" class="btn btn-primary mt-2">
                            Войти
                        </button>

                        <preloader v-if="isLoading" class="mt-2" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { login, getCSRF } from '../../api/auth';

export default {
    name: "Auth",

    data() {
        return {
            email: null,
            password: null,
            error: false,
            isLoading: false,
        }
    },

    created() {
        getCSRF();
    },

    methods: {
        sendLoginDataToServer() {
            this.isLoading = true;
            this.error = false;

            login({
                email: this.email,
                password: this.password
            })
                .then(({ token, role }) => {
                    this.$store.commit('setUser', { token, role });

                    const userRole = this.$store.getters.userRole;
                    const redirectPath = userRole === 'admin' ? '/admin' :
                    userRole === 'courier' ? '/courier' :
                    userRole === 'client' ? '/client' : '/';

                    this.$router.push(redirectPath);
                })
                .catch((e) => {
                    console.log(e);
                    this.error = true;
                })
                .finally(() => {
                    this.isLoading = false;
                })
        },
    },
}
</script>

<style scoped>
    .error {
        text-align: center;
        color: red;
        margin: 15px 0;
        max-width: 220px;
    }
</style>
