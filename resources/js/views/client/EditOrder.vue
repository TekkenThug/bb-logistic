<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <preloader v-if="preloader" class="mt-5" />
            <CreateForm v-else @serializeForm="updateOrder"
                        :order="order"
                        ref="form"
            />
        </div>
    </div>
</template>

<script>
import CreateForm from "../../components/CreateForm";

export default {
    name: "EditOrder",
    components: { CreateForm },
    data() {
        return {
            order: {},
            preloader: true
        }
    },
    beforeMount() {
       axios.get(`/orders/${this.$route.params.order_id}?role=client`)
        .then(res => {
            if (res.data.status === "fail") {
                console.log('fail')
                this.$router.push('/client/list');
            } else {
                this.order = res.data.order;
            }

            this.preloader = false
        })
    },
    updated: function() {
        this.$refs.form.completedForm();
    },
    methods: {
        updateOrder(obj) {
            axios.patch(`/orders/${this.$route.params.order_id}?role=client`, obj)
                .then(res => {
                    if (res.data.status === "success") {
                        this.$router.push('/client/list');
                    }
                })
        }
    },
}
</script>

<style scoped>

</style>
