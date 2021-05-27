<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="login-form-wrapper">
                    <img class="login-form__img" src="/images/logo.png" alt="bandb">
                    <form class="login-form" method="POST" action="">
                        <div class="form-group login">
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                   placeholder="Логин" required value="">

                            <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>

                        </div>
                        <div class="form-group password">
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль" required>

                            <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>

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
    name: "Auth"
}
</script>

<style scoped>

</style>
