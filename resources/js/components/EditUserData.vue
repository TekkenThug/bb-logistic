<template>
    <div class="admin-create__form mt-5" >
        <h4 class="admin-create__form-title">Изменить</h4>
        <div class="admin-create__form-inner">
            <div class="admin-create__row">
                <h4>Имя {{ user === 'client' ? 'клиента' : 'курьера'}}:</h4>
                <input v-model="name" class="form-control" type="text" name="name"
                       placeholder="Введите имя" required>
            </div>
            <div v-if="user === 'courier'" class="admin-create__row">
                <h4>Номер телефона:</h4>
                <input v-model="phone" class="form-control" type="text" name="phone"
                       placeholder="Введите номер телефона"
                       required>
            </div>
            <div class="admin-create__row">
                <h4>Email:</h4>
                <input v-model="email" class="form-control" type="text" name="email"
                       placeholder="Введите email" required>
            </div>
            <div v-if="user === 'client'" class="admin-create__row is-client">
                <h4>Адрес забора посылки:</h4>
                <input v-model="address" class="form-control" type="text" name="address"
                       placeholder="Введите адрес забора"
                       required>
            </div>
            <div class="admin-create__row">
                <h4>Новый пароль:</h4>
                <input v-model="password" class="form-control" type="password" name="password" placeholder="Введите пароль">
            </div>
            <div class="admin-create__row">
                <h4>Повторите пароль:</h4>
                <input v-model="repeatPassword" class="form-control" type="password" name="password"
                       placeholder="Введите пароль ещё раз">
            </div>
        </div>
        <button @click="serializeUpdateUser" class="btn btn-primary mt-4 w-100" type="submit">Изменить учетную запись</button>
        <button class="btn btn-danger mt-4 w-100" type="submit">Удалить учетную запись</button>
    </div>
</template>

<script>
export default {
    name: "EditUserData",
    data() {
        return {
            name: this.obj.name,
            email: this.obj.email,
            password: "",
            repeatPassword: "",
            address: this.obj.address,
            phone: this.obj.phone
        }
    },
    props: {
        obj: {
            type: Object,
            default() {
                return {}
            }
        },
        user: {
            type: String,
            default: ""
        },
    },
    methods: {
        serializeUpdateUser() {
            let obj = {
                name: this.name,
                email: this.email,
                address: this.address,
                phone: this.phone
            }

            if (this.password.trim().length !== 0
                && this.repeatPassword.trim().length !== 0
                && this.password.trim() === this.repeatPassword.trim()) {
                obj.password = this.password.trim()
            }

            this.$emit('serialize', obj);
        }
    }
}
</script>

<style scoped>

</style>
