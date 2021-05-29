<template>
    <div>
        <Navbar role="client" />
        <div class="container">
            <router-view></router-view>
        </div></div>
</template>

<script>
import Navbar from '../../components/Navbar';

export default {
    name: "Client",
    components: { Navbar }
}
</script>

<style scoped>

</style>
