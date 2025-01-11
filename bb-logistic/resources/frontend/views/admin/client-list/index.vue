<script lang="ts" setup>
import { onBeforeMount, ref } from 'vue';
import { getAll } from '@/services/api/clients';
import { useToast } from '@/components/ui/toast';
import { Table, TableHeader, TableHead, TableRow, TableBody, TableCell } from '@/components/ui/table';

const { toast } = useToast();

const list = ref<Awaited<ReturnType<typeof getAll>>>([]);
const heading = ['ID', 'Имя', 'Email', 'Адрес'];

onBeforeMount(async () => {
  try {
    list.value = await getAll();
  } catch (error) {
    toast({ title: 'Ошибка', description: error });
  }
});
</script>

<template>
  <section>
    <h2>
      Список клиентов
    </h2>

    <Table>
      <TableHeader>
        <TableRow>
          <TableHead
            v-for="item in heading"
            :key="item"
          >
            {{ item }}
          </TableHead>
        </TableRow>
      </TableHeader>

      <TableBody>
        <TableRow
          v-for="item in list"
          :key="item.id"
        >
          <TableCell>
            {{ item.id }}
          </TableCell>

          <TableCell>
            {{ item.last_name }} {{ item.first_name }}
          </TableCell>

          <TableCell>
            {{ item.email }}
          </TableCell>

          <TableCell>
            {{ item.address }}
          </TableCell>
        </TableRow>
      </TableBody>
    </Table>
  </section>
</template>

<!-- <template>
  <div class="row">
    <div class="col-lg-6 offset-lg-3">
      <div class="admin-client-list overall">
        <h4>Список клиентов:</h4>
        <SearchInput
          v-model="searchText"
          style="margin-bottom: 20px"
          placeholder="Поиск по клиентам..."
        />

        <div class="admin__client-list">
          <UIPreloader v-if="isLoading" />

          <UserRow
            v-for="client in clients"
            :id="client.id"
            :key="client.id"
            :path="'/admin/clients/'"
            :role="'client'"
            :name="client.name"
            :email="client.email"
            :address="client.delivery_address"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SearchInput from '@/components/search-input';
import UserRow from '@/components/user-row';

export default {
    name: 'ClientList',
    components: {SearchInput, UserRow},
    data() {
        return {
            clients: [],
            isLoading: true,
            searchText: '',
            stopSearch: false,
        };
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
        });
    },
    methods: {
        getOrderNumber() {
            if (!this.stopSearch) {
                this.stopSearch = true;
                this.clients = [];
                this.isLoading = true;
                axios.get(`/clients?name=${this.searchText}`).then(res => {
                    console.log(res.data);
                    this.clients = res.data.clients;
                    this.isLoading = false;
                    this.stopSearch = false;
                });
            }
        }
    }
};
</script> -->