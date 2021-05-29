<template>
    <div>
        <Navbar role="admin" />
        <div class="container">
            <router-view></router-view>
        </div>
        <v-footer></v-footer>
    </div>
</template>

<script>
import Navbar from "../../components/Navbar";

export default {
    name: "Admin",
    components: { Navbar },
}
</script>

<style scoped>

</style>
