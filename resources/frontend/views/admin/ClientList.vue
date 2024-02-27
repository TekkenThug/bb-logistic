<template>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="admin-client-list overall">
                <h4>Список клиентов:</h4>
                <SearchInput v-model="searchText" style="margin-bottom: 20px" placeholder="Поиск по клиентам..."/>

                <div class="admin__client-list">
                    <UIPreloader v-if="isLoading" />

                    <UserRow v-for="client in clients"
                             :path="'/admin/clients/'"
                             :role="'client'"
                             :key="client.id"
                             :name="client.name"
                             :id="client.id"
                             :email="client.email"
                             :address="client.delivery_address"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SearchInput from "@/components/search-input";
import UserRow from "@/components/user-row";

export default {
    name: "ClientList",
    components: {SearchInput, UserRow},
    data() {
        return {
            clients: [],
            isLoading: true,
            searchText: "",
            stopSearch: false,
        }
    },
    methods: {
        getOrderNumber() {
            if (!this.stopSearch) {
                this.stopSearch = true;
                this.clients = [];
                this.isLoading = true;
                axios.get(`/clients?name=${this.searchText}`).then(res => {
                    console.log(res.data)
                    this.clients = res.data.clients;
                    this.isLoading = false;
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
        axios.get('/clients').then(res => {
            this.clients = res.data.clients;
            this.isLoading = false;
        })
    }
}
</script>