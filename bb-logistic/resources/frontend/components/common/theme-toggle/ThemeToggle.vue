<template>
    <button
        :class="[$style.ThemeToggle, $style[store.theme]]"
        @click="store.toggleTheme"
    >
        <UIIcon :class="$style.icon" name="moon" />

        <UIIcon :class="$style.icon" name="sun" />
    </button>
</template>

<script setup>
import UIIcon from "@/components/UI/icon/UIIcon";
import { useAppStore } from "@/store/app";

const store = useAppStore();
</script>

<style lang="scss" module>
    .ThemeToggle {
        border-radius: 1000px;
        border: 1px solid #E5E7EB;
        color: #fff;

        &::before {
            content: "";
            position: absolute;
            width: 36px;
            height: 36px;
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
            transform: translateX(36px);
        }
    }

    .icon {
        --ui-icon-size: 20px;

        position: relative;
        padding: 8px;
    }
</style>
