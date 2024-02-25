<template>
    <div :class="$style.wrapper">
        <img src="/images/preloader.svg" alt="preloader">
    </div>
</template>

<script>
export default {
    name: "UIPreloader"
}
</script>

<style module>
    .wrapper {
        text-align: center;
    }

    .wrapper img {
        width: 80px;
    }
</style>
