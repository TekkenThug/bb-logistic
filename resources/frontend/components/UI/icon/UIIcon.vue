<template>
    <i :class="classes"></i>
</template>

<script setup>
import { computed } from "vue";

import 'primeicons/primeicons.css';

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
});

const classes = computed(() => ['pi', `pi-${props.name}`]);
</script>

<style>
    :root {
        --ui-icon-size: 16px;
    }

    .pi {
        font-size: var(--ui-icon-size);
    }
</style>