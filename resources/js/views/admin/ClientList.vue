<template>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="admin-client-list overall">
                <h4>Список клиентов:</h4>
                <SearchInput style="margin-bottom: 20px" placeholder="Поиск по клиентам..."/>

                <div class="admin__client-list">
                    <UserRow v-for="client in clients"
                             :key="client.id"
                             :name="client.name"
                             :email="client.email"
                             :address="client.delivery_address"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SearchInput from "../../components/SearchInput";
import UserRow from "../../components/UserRow";

export default {
    name: "ClientList",
    components: {SearchInput, UserRow},
    data() {
        return {
            clients: [],
        }
    },
    mounted() {
        axios.get('/api/clients').then(res => {
            console.log(res.data.clients);
            this.clients = res.data.clients
        })
    }
}


</script>

<style scoped>

</style>
