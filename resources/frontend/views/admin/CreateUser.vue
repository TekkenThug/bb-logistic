<template>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="admin-create overall">
                <form class="admin-create__form" method="POST" @submit.prevent="createUser">
                    <h4 class="admin-create__form-title">Создание учетной записи</h4>
                    <div class="admin-create__form-inner">
                        <div class="admin-create__row">
                            <h4>Тип учетной записи:</h4>
                            <label>Администратор <input type="radio" name="role" v-model="role" value="admin" required></label>
                            <label>Клиент <input type="radio" name="role" v-model="role" value="client" required></label>
                            <label>Курьер <input type="radio" name="role" v-model="role" value="courier" required></label>
                        </div>
                        <div class="admin-create__row">
                            <h4>Имя:</h4>
                            <input v-model="name" class="form-control" type="text" name="name" placeholder="Введите имя" required>
                        </div>
                        <div class="admin-create__row">
                            <h4>E-mail:</h4>
                            <input v-model="email" class="form-control" type="email" name="email" placeholder="Введите e-mail" required>
                        </div>
                        <div class="admin-create__row">
                            <h4>Пароль:</h4>
                            <input v-model="password" class="form-control" type="password" name="password" placeholder="Введите пароль" required>
                        </div>
                        <div class="admin-create__row">
                            <h4>Повторите пароль:</h4>
                            <input v-model="passwordDuplicate" class="form-control" type="password" name="password_confirmation" placeholder="Введите пароль ещё раз" required>
                        </div>
                        <div v-if="role === 'client'" class="admin-create__row">
                            <h4>Адрес забора посылки:</h4>
                            <input v-model="deliveryAddress" class="form-control" type="text" name="delivery_address" placeholder="Введите адрес забора" required>
                        </div>

                        <div v-if="role === 'courier'" class="admin-create__row">
                            <h4>Номер телефона:</h4>
                            <input v-model="phone" class="form-control" type="text" name="phone_number" placeholder="Введите номер телефона" required>
                        </div>
                    </div>
                    <div v-if="errors.length > 0" class="alert alert-danger mt-3" role="alert">
                        <span v-for="(error, index) in errors" :key="index" class="d-block">{{ error }}</span>
                    </div>
                    <button class="btn btn-primary mt-4 w-100" type="submit">Создать учетную запись</button>
                    <preloader class="mt-2" v-if="preloader" />
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CreateUser",
    data() {
        return {
            name: '',
            email: '',
            password: '',
            passwordDuplicate: '',
            role: "admin",
            deliveryAddress: '',
            phone: '',
            errors: [],
            preloader: false,
        }
    },
    methods: {
        createUser(){
            this.preloader = true;
            if (this.password === this.passwordDuplicate) {
                this.$auth.register({
                    data: {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        role: this.role,
                        deliveryAddress: this.deliveryAddress,
                        phone: this.phone
                    },
                    redirect: null
                }).then(res => {
                    if (res.data.status === "success") {
                        this.cleanFields();
                        this.preloader = false;
                    }
                }).catch(error => {
                    this.extractErrors(error.response.data.errors)
                    this.preloader = false;
                });

            } else {
                this.preloader = false;
                this.errors.push("Пароли не совпадают");
            }
        },
        cleanFields() {
            this.name = this.email = this.password = this.passwordDuplicate = this.phone = this.deliveryAddress = '';
            this.role = "admin";
        },
        extractErrors(errors) {
            for (let key in errors) {
                errors[key].forEach(str => this.errors.push(str));
            }
        }
    },
    watch: {
        name() { this.errors = [] },
        email() { this.errors = [] },
        password() { this.errors = [] },
        role() { this.errors = [] },
    }
}
</script>
