<template>
    <div>
        <Navbar role="courier" />
        <div class="container">
            <router-view></router-view>
        </div>
        <v-footer></v-footer>
    </div>
</template>

<script>
import Navbar from "../../components/Navbar";

export default {
    name: "Courier",
    components: { Navbar }
}
</script>

<style scoped>

</style>
