<template>
    <header :class="[$style.TheHeader, 'header']">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 col-sm-2 d-flex justify-content-center align-items-center">
                    <!-- <img src="/images/header/logo.png" alt="bandb"> -->
                </div>
                
                <div class="col-6 col-sm-8">
                    <ul :class="$style.navList">
                        <router-link
                            v-for="item in items"
                            :key="item.text"
                            :to="{ name: item.routeName }"
                            tag="li"
                            :class="$style.navItem"
                        >
                            <UIIcon :name="item.icon" :size="32" />

                            <span :class="$style.navItemText">{{ item.text }}</span>
                        </router-link>
                    </ul>
                </div>

                <div class="col-3 col-sm-2 d-flex justify-content-center align-items-center">
                    <button
                        :class="$style.logoutButton"
                        @click="signOut"
                    >
                        Выйти <UIIcon name="sign-out" />
                    </button>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import { computed } from "vue";
import UIIcon from "@/components/UI/icon/UIIcon";
import { logout } from '@/services/api/auth';
import { useRouter } from "vue-router";
import { useStore } from "vuex";

const router = useRouter();
const signOut = async () => {
    await logout();
    await router.push({ name: "login" });
};

const store = useStore();
const role = computed(() => store.state.user?.role);
const items = computed(() => {
    switch (role.value) {
        case "client":
            return [
                {
                    icon: "pencil",
                    routeName: "client-create-order",
                    text: "Оформить доставку"
                },
                {
                    icon: "list",
                    routeName: "client-order-list",
                    text: "Список заявок"
                },
                {
                    icon: "box",
                    routeName: "client-fullfilment",
                    text: "Фуллфилмент"
                }
            ]

        case "courier":
            return [
                {
                    icon: "directions",
                    routeName: "courier-opened-orders",
                    text: "Открытые заказы"
                },
                {
                    icon: "stopwatch",
                    routeName: "courier-closed-orders",
                    text: "Закрытые заказы"
                },
            ]

        case "admin":
            return [
                {
                    icon: "directions",
                    routeName: "admin-create-user",
                    text: "Создать пользователя"
                },
                {
                    icon: "list",
                    routeName: "admin-client-list",
                    text: "Список клиентов"
                },
                {
                    icon: "list",
                    routeName: "admin-courier-list",
                    text: "Список курьеров"
                },
                {
                    icon: "list",
                    routeName: "admin-create-user",
                    text: "Создать пользователя"
                },
                {
                    icon: "list",
                    routeName: "admin-order-list",
                    text: "Список заявок"
                },
                {
                    icon: "box",
                    routeName: "admin-fullfilment",
                    text: "Фулфилмент"
                }
            ];

        default:
            return []
    }
});
</script>

<style lang="scss" module>
    .TheHeader {
        background-color: $primary-100;
        padding: 20px 0;
        text-align: right;

        img {
            width: 80px;
        }
    }

    .logoutButton {
        gap: 8px;
        display: flex;
        align-items: center;
        cursor: pointer;
        color: #ffffff;
        transition: all 0.2s ease;
        position: relative;
        padding-left: 20px;

        @include hover {
            color: rgba(255, 255, 255, 0.7);
        }
    }

    .navList {
        margin: 0;
        padding: 0;
        list-style: none;
        text-align: center;
        display: flex;
        justify-content: center;
        flex-direction: row;
        align-items: center;
        color: #ffffff;
    }

    .navItem {
        --ui-icon-size: 32px;

        padding: 10px;
        color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-decoration: none;
        font-weight: 600;

        @include hover {
            color: #fff;
        }
    }

    .navItemText {
        margin-top: 10px;
        font-size: 14px;
        line-height: 16px;
        max-width: 140px;
    }
</style>
