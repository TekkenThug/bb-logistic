<template>
    <div>
        <Navbar role="courier" />
        <div class="container">
            <router-view></router-view>
        </div>
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
