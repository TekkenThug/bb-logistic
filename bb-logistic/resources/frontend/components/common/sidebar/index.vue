<template>
  <aside :class="$style.sidebar">
    <img
      :class="$style.logo"
      :src="logo"
      alt="bandb"
    >

    <ul :class="$style.navList">
      <router-link
        v-for="item in items"
        :key="item.text"
        :to="{ name: item.routeName }"
        tag="li"
        :class="$style.navItem"
      >
        <Icon :icon="item.icon" />

        <span :class="$style.navItemText">{{ item.text }}</span>
      </router-link>
    </ul>

    <button
      :class="$style.logoutButton"
      @click="signOut"
    >
      <Icon icon="lucide:log-out" /> Выйти
    </button>
  </aside>
</template>

<script setup>
import { computed } from 'vue';
import { useRouter } from 'vue-router';
import { useUserStore } from '@/store/user';
import { NAVIGATION } from '@/data/constants';
import { logout } from '@/services/api/auth';
import { Icon } from '@iconify/vue';
import logo from '@/assets/images/common/logo.png';

const userStore = useUserStore();
const router = useRouter();

const signOut = async () => {
    await logout();
    await router.push({ name: 'auth' });
};

const items = computed(() => {
    return NAVIGATION[userStore.role] ?? [];
});
</script>

<style lang="scss" module>
.sidebar {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 20px;
    background-color: $blue-600;
}

.logo {
    width: 80px;
}

.navList {
    display: flex;
    flex-direction: column;
    gap: 24px;
    margin-top: 40px
}

.navItem {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
}

.logoutButton {
    display: flex;
    gap: 10px;
    align-items: center;
    margin-top: auto;
}
</style>