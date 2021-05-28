<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <preloader v-if="preloader" />
            <CreateForm @serializeForm="createOrder" newOrder />
        </div>
    </div>
</template>

<script>
import CreateForm from "../../components/CreateForm";

export default {
    name: "CreateOrder",
    components: { CreateForm },
    data() {
        return {
            preloader: false,
        }
    },
    methods: {
        createOrder(obj) {
            this.preloader = true;
            console.log(obj);
        }
    }
}
</script>

<style scoped>

</style>
