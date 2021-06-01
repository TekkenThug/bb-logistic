<template>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="admin-client-list overall">
                <h4>Список курьеров:</h4>
                <SearchInput v-model="searchText" style="margin-bottom: 20px" placeholder="Поиск по курьерам..."/>
                <div class="admin__client-list">
                    <preloader v-if="preloader" />
                    <UserRow v-for="courier in couriers"
                             :role="'courier'"
                             :path="'/admin/couriers/'"
                             :key="courier.id"
                             :id="courier.id"
                             :name="courier.name"
                             :email="courier.email"
                             :comment="courier.courier_comment"
                             :phone="courier.phone_number"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SearchInput from "../../components/SearchInput";
import UserRow from "../../components/UserRow";

export default {
    name: "CourierList",
    components: { SearchInput, UserRow },
    data() {
        return {
            couriers: [],
            preloader: true,
            searchText: "",
            stopSearch: false,
        }
    },
    methods: {
        getOrderNumber() {
            if (!this.stopSearch) {
                this.stopSearch = true;
                this.couriers = [];
                this.preloader = true;
                axios.get(`/couriers?name=${this.searchText}`).then(res => {
                    console.log(res.data)
                    this.couriers = res.data.couriers;
                    this.preloader = false;
                    this.stopSearch = false;
                })
            }
        }
    },
    watch: {
        searchText() {
            this.getOrderNumber();
        }
    },
    mounted() {
        axios.get('/couriers').then(res => {
            this.couriers = res.data.couriers;
            this.preloader = false;
        })
    }
}
</script>

<style scoped>

</style>
