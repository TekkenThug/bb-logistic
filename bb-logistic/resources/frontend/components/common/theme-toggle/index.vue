
<template>
  <Switch
    :checked="store.theme === 'dark'"
    @update:checked="store.toggleTheme"
  >
    <template #thumb>
      <Icon
        v-if="store.theme === 'dark'"
        icon="lucide:moon"
        class="size-3"
      />

      <Icon
        v-else
        icon="lucide:sun"
        class="size-3"
      />
    </template>
  </Switch>
</template>

<script setup>
import { Icon } from '@iconify/vue';
import { Switch } from '@/components/ui/switch';
import { useAppStore } from '@/store/app';

const store = useAppStore();
</script>
