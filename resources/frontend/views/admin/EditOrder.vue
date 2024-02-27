<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <UILoader v-if="preloader" />
            <CreateForm v-else
                        :clients="clients"
                        :couriers="couriers"
                        :order="order"
                        ref="form"
                        @serializeForm="updateOrder"
                        is-admin
            />
        </div>
    </div>
</template>

<script>
import CreateForm from "@/components/forms/create-form"

export default {
    name: "EditOrder",
    components: {CreateForm},
    data() {
        return {
            couriers: [],
            preloader: true,
            order: {},
            clients: []
        }
    },
    methods: {
        updateOrder(obj) {
            axios.patch(`/orders/${this.$route.params.id}?role=admin`, obj)
                .then(res => {
                    if (res.data.status === "success") {
                        this.$router.push('/admin/orders');
                    }
                })
        }
    },
    updated() {
        this.$refs.form.completedForm();
    },
    beforeMount() {
        axios.get(`/orders/${this.$route.params.id}?role=admin`)
            .then(res => {
                if (res.data.status === "fail") {
                    console.log('fail')
                    this.$router.push('/admin/orders');
                } else {
                    this.order = res.data.order;
                }

                this.preloader = false
            })
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

<style scoped>

</style>
