<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
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
            axios.post('/orders', obj)
                .then(res => console.log(res.data))
        }
    }
}
</script>

<style scoped>

</style>
