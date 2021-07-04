<template>
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 col-sm-2 d-flex justify-content-center align-items-center">
                    <img src="/images/header/logo.png" alt="bandb">
                </div>
                <div class="col-6 col-sm-8">
                    <ul class="sidebar__list">
                        <li v-if="role === 'client'" class="sidebar__item">
                            <router-link to="/client/create"><img src="/images/sidebar/pen.svg" alt="pen"><span>Оформить доставку</span>
                            </router-link>
                        </li>
                        <li v-if="role === 'client'" class="sidebar__item">
                            <router-link to="/client/list"><img src="/images/sidebar/clipboard.svg" alt="list"><span>Список заявок</span>
                            </router-link>
                        </li>

                        <li v-if="role === 'courier'" class="sidebar__item">
                            <router-link to="/courier/open"><img src="/images/sidebar/open.svg" alt="pen"><span>Открытые заказы</span>
                            </router-link>
                        </li>
                        <li v-if="role === 'courier'" class="sidebar__item">
                            <router-link to="/courier/close"><img src="/images/sidebar/close.svg" alt="list"><span>Закрытые заказы</span>
                            </router-link>
                        </li>

                        <li v-if="role === 'admin'" class="sidebar__item">
                            <router-link to="/admin/create-user"><img src="/images/sidebar/account.svg" alt="pen"><span>Учетные записи</span></router-link>
                        </li>
                        <li v-if="role === 'admin'" class="sidebar__item">
                            <router-link to="/admin/clients"><img src="/images/sidebar/customer.svg" alt="list"><span>Список клиентов</span></router-link>
                        </li>
                        <li v-if="role === 'admin'" class="sidebar__item">
                            <router-link to="/admin/couriers"><img src="/images/sidebar/delivery-man.svg" alt="list"><span>Список курьеров</span></router-link>
                        </li>
                        <li v-if="role === 'admin'" class="sidebar__item">
                            <router-link to="/admin/orders"><img src="/images/sidebar/clipboard.svg" alt="list"><span>Список заявок</span></router-link>
                        </li>
                        <li v-if="role === 'admin'" class="sidebar__item">
                            <router-link to="/admin/fulfillment"><img src="/images/sidebar/box.svg" alt="list"><span>Фулфилмент</span></router-link>
                        </li>
                    </ul>
                </div>
                <div class="col-3 col-sm-2 d-flex justify-content-center align-items-center">
                    <a class="header__logout" @click="logout()">Выйти</a>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: "Navbar",
    props: {
        role: {
            type: String,
            default: ""
        }
    },
    methods: {
        logout() {
            this.$auth
                .logout({
                    makeRequest: true,
                    redirect: {name: 'login'},
                });
        }
    }
}
</script>

<style scoped>
    .header__logout {
        cursor: pointer;
    }
</style>
