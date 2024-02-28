<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <CreateForm :clients="clients"
                        :couriers="couriers"
                        @serializeForm="createOrder"
                        is-admin
                        new-order/>
        </div>
    </div>
</template>

<script>
import CreateForm from "@/components/forms/create-form"

export default {
    name: "CreateOrder",
    components: {CreateForm},
    data() {
        return {
            couriers: [],
            clients: []
        }
    },
    methods: {
        createOrder(obj) {
            axios.post('/orders', obj)
                .then(res => {
                    if (res.data.status === "success") {
                        this.$router.push('/admin/orders');
                    }
                })
        }
    },
    beforeCreate() {
        axios.get('/clients').then(res => {
            this.clients = res.data.clients
        })

        axios.get('/couriers').then(res => {
            this.couriers = res.data.couriers
        })
    }
}
</script>