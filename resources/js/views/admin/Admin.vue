<template>
    <div>
        <Navbar role="admin" />
        <div class="container">
            <router-view></router-view>
        </div>
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
