<template>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="login-form-wrapper">
                    <img class="login-form__img" src="/images/logo.png" alt="bandb">
                    <form class="login-form" method="POST" @submit.prevent="login" >
                        <div class="form-group login">
                            <input v-model="email" type="text" name="email" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp"
                                   placeholder="Логин" required value="">
                        </div>
                        <div class="form-group password">
                            <input v-model="password" type="password" name="password" class="form-control"
                                   id="exampleInputPassword1" placeholder="Пароль" required>
                        </div>
                        <div v-if="error" class="error" role="alert">
                            Пожалуйста, проверьте введенные данные.
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Войти</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


</template>

<script>
export default {
    name: "Auth",
    data() {
        return {
            email: null,
            password: null,
            error: false,
        }
    },
    methods: {
        login() {
            this.$auth.login({
                data: {
                    email: this.email,
                    password: this.password
                },
                rememberMe: true,
                staySignedIn: true,
                fetchUser: true,
            }).then(() => {
                    const redirectPath = this.$auth.user().role_id === 1 ? '/admin' :
                        this.$auth.user().role_id === 2 ? '/client' : '/courier'

                    this.$router.push(redirectPath);
                }
            ).catch(() => {
                this.error = true;
            });
        },
    },
    watch: {
        error(val) {
            if (val) {
                this.email = null;
                this.password = null
            }
        },
        email(val) {
            if (this.error === true && val.length !== 0)
                this.error = false;
        }
    }
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
