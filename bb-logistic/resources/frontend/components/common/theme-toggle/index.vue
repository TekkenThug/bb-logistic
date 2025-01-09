<template>
  <button
    :class="[$style.ThemeToggle, $style[store.theme]]"
    @click="store.toggleTheme"
  >
    <div :class="$style.container">
      <Icon
        icon="lucide:moon"
        :class="$style.icon"
      />
    </div>

    <div :class="$style.container">
      <Icon
        icon="lucide:sun"
        :class="$style.icon"
      />
    </div>
  </button>
</template>

<script setup>
import { Icon } from "@iconify/vue";
import { useAppStore } from "@/store/app";

const store = useAppStore();
</script>

<style lang="scss" module>
.ThemeToggle {
    display: flex;
    border-radius: 1000px;
    border: 1px solid #E5E7EB;
    color: #fff;
    height: max-content;

    &::before {
        content: "";
        position: absolute;
        width: 50%;
        height: 100%;
        border-radius: 50%;
        top: 0;
        left: 0;
        transition: all .3s ease;
    }

    &.dark::before {
        background-color: #1D4ED8;
    }

    &.light::before {
        background-color: #FDE047;
        transform: translateX(100%);
    }
}

.container {
    padding: 4px;
}

.icon {
    position: relative;
    width: 16px;
    height: 16px;
    color: black;
}
</style>
