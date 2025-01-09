<script setup>
import { computed } from 'vue';
import { useRouter } from 'vue-router';
import { Tooltip, TooltipContent, TooltipTrigger, TooltipProvider } from '@/components/ui/tooltip';
import { Button } from '@/components/ui/button';
import { useUserStore } from '@/store/user';
import { NAVIGATION } from '@/data/constants';
import { logout } from '@/services/api/auth';
import { Icon } from '@iconify/vue';

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

<template>
  <aside class="inset-y fixed left-0 z-20 flex h-full flex-col border-r">
    <div class="border-b p-2">
      <Button
        variant="outline"
        size="icon"
        aria-label="Home"
      >
        <Icon icon="lucide:triangle" />
      </Button>
    </div>

    <nav class="grid gap-1 p-2">
      <Tooltip
        v-for="item in items"
        :key="item.text"
      >
        <TooltipTrigger as-child>
          <router-link :to="{ name: item.routeName }">
            <Button
              variant="ghost"
              size="icon"
              class="rounded-lg"
              :aria-label="item.text"
            >
              <Icon :icon="item.icon" />
            </Button>
          </router-link>
        </TooltipTrigger>
        
        <TooltipContent
          side="right"
          :side-offset="5"
        >
          {{ item.text }}
        </TooltipContent>
      </Tooltip>
    </nav>
    <nav class="mt-auto grid gap-1 p-2">
      <Tooltip>
        <TooltipTrigger as-child>
          <Button
            variant="ghost"
            size="icon"
            class="mt-auto rounded-lg"
            aria-label="Выйти"
            @click="signOut"
          >
            <Icon icon="lucide:log-out" />
          </Button>
        </TooltipTrigger>

        <TooltipContent
          side="right"
          :side-offset="5"
        >
          Выйти
        </TooltipContent>
      </Tooltip>
    </nav>
  </aside>
</template>