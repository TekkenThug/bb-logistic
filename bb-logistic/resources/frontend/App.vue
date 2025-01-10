<template>
  <TooltipProvider>
    <div>
      <div
        v-if="isLoading"
        class="flex justify-center items-center h-dvh"
      >
        <Progress
          :model-value="status"
          class="w-72"
        />
      </div>

      <RouterView v-else />
    </div>

    <Toaster />
  </TooltipProvider>
</template>

<script setup>
import { watch, onBeforeMount, ref } from 'vue';
import { useRouter } from 'vue-router';
import { getCSRF, me } from '@/services/api/auth';
import { Progress } from '@/components/ui/progress';
import { TooltipProvider } from '@/components/ui/tooltip';
import { Toaster } from '@/components/ui/toast';

import { useAppStore } from '@/store/app';
import { useUserStore } from '@/store/user';

const router = useRouter();
const appStore = useAppStore();
const userStore = useUserStore();

const isLoading = ref(false);
const status = ref(15);

watch(() => appStore.theme, (value) => {
    if (value === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}, {
    immediate: true,
});

onBeforeMount(async () => {
    isLoading.value = true;

    await getCSRF();

    status.value += 15;

    try {
        const { data } = await me();

        status.value += 15;

        userStore.setupUser(data);

        await router.push({ path: `/${userStore.role}` });

        status.value = 100;

        isLoading.value = false;
    } catch (error) {
        if (error.status === 401) {
            await router.push({ name: 'auth' });
            status.value = 100;
            isLoading.value = false;
        }
    }
});
</script>
