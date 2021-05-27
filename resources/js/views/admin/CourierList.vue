<template>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="admin-client-list overall">
                <h4>Список курьеров:</h4>
                <SearchInput style="margin-bottom: 20px" placeholder="Поиск по курьерам..."/>

                <div class="admin__client-list">
                    <UserRow />
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
    components: { SearchInput, UserRow }
}
</script>

<style scoped>

</style>
