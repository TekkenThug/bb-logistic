<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

import { login } from '@/services/api/auth';

import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useUserStore } from '@/store/user';

import bg from '@/assets/images/auth_bg.jpg';

const router = useRouter();
const userStore = useUserStore();

const loginCredentials = ref<{ email: string, password: string }>({ email: '', password: '' });
const isError = ref(false);
const isLoading = ref(false);

const sendLoginDataToServer = async () => {
  isLoading.value = true;
  isError.value = false;

  if (loginCredentials.value.email === null || loginCredentials.value.password === null) {
    return;
  }

  try {
    const { data } = await login(loginCredentials.value);

    userStore.setupUser(data);

    await router.push({ path: `/${userStore.role}` });
  } catch (_) {
    isError.value = true;
  } finally {
    isLoading.value = false;
  }
};
</script>

<template>
  <div class="w-full lg:grid lg:grid-cols-2 h-dvh">
    <div class="flex items-center justify-center py-12">
      <div class="mx-auto grid w-[350px] gap-6">
        <div class="grid gap-2 text-center">
          <h1 class="text-3xl font-bold">
            Вход
          </h1>

          <p class="text-balance text-muted-foreground">
            Введите свою почту и пароль для входа в аккаунт
          </p>
        </div>

        <div class="grid gap-4">
          <div class="grid gap-2">
            <Label for="email">Email</Label>

            <Input
              v-model="loginCredentials.email"
              type="email"
              placeholder="example@ya.ru"
              required
            />
          </div>

          <div class="grid gap-2">
            <Label for="password">Пароль</Label>

            <Input
              v-model="loginCredentials.password"
              type="password"
              required
            />
          </div>

          <Button
            type="submit"
            class="w-full"
            @click="sendLoginDataToServer"
          >
            Вход
          </Button>
        </div>
      </div>
    </div>

    <div class="hidden bg-muted lg:block">
      <img
        :src="bg"
        alt="Image"
        width="1920"
        height="1080"
        class="h-full w-full object-cover dark:brightness-[0.2] dark:grayscale"
      >
    </div>
  </div>
</template>
