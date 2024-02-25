<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <CreateForm @serializeForm="createOrder" newOrder />
        </div>
    </div>
</template>

<script>
import CreateForm from "@/components/forms/create-form";

export default {
    name: "CreateOrder",
    components: { CreateForm },
    methods: {
        createOrder(obj) {
            axios.post('/orders', obj)
                .then(res => {
                    if (res.data.status === "success") {
                        this.$router.push('/client/list');
                    }
                })
        }
    }
}
</script>

<style scoped>

</style>
