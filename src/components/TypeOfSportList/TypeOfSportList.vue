<template>
  <div class="list">
    <Table
        :headers="[
          {value: 'id', text: 'ID', type: 'text'},
          {value: 'name', text: 'Вид спорта', type: 'sort-link'},
          {value: 'control', text: 'Действие'},
        ]"
        :items="items"
    >
      <template v-slot:control="{ item }">
        <div class="btn-control">
          <Btn @click="onClickSort(item.id)"  class="link">Показать</Btn>
          <Btn @click="onClickEdit(item.id)"  class="info">Изменить</Btn>
          <Btn @click="onClickRemove(item.id)" class="danger">Удалить</Btn>
        </div>
      </template>
    </Table>
    <RouterLink :to="{ name: 'TypeOfSportEdit' }">
      <Btn class="list__create info">Создать</Btn>
    </RouterLink>
  </div>
</template>

<script>
import { useStore } from 'vuex';
import { computed, onMounted } from 'vue';
import { useRouter } from 'vue-router';

import {removeTypeOfSportItem, fetchTypeOfSportItems, selectTypeOfSportItems} from '@/store/typeofsport/selectors'
import Table from '@/components/Table/Table';
import Btn from '@/components/Btn/Btn';
export default {
  name: 'TypeOfSportList',
  components: {
    Btn,
    Table,
  },
  setup() {
    const store = useStore();
    const router = useRouter();

    onMounted(() => {
      fetchTypeOfSportItems(store);
    });

    return {
      items: computed(() => selectTypeOfSportItems(store)),
      onClickRemove: id => {
        const isConfirmRemove = confirm('Вы действительно хотите удалить запись?')
        if (isConfirmRemove) {
          removeTypeOfSportItem(store, id)
        }
      },
      onClickEdit: ( id ) => {
        router.push({ name: 'TypeOfSportEdit', params: { id } })
      },
      onClickSort: (type_id) => {
        router.push({ name: 'Sportsmans', params: {filter_field: 'type_sport_id', filter_value: type_id } })
      }

    }
  },
}
</script>