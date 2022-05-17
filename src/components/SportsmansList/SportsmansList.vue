<template>
  <div class="list">
    <Table
      :headers="[
        {value: 'id', text: 'ID', type: 'text'},
        {value: 'name', text: 'ФИО', type: 'text'},
        {value: 'photo', text: 'Фотография', type: 'img'},
        {value: 'type_sport', text: 'Вид спорта', type: 'array', field: 'name'},
        {value: 'biography', text: 'Биография', type: 'link'},
        {value: 'year', text: 'Год начала карьеры', type: 'date'},
        {value: 'control', text: 'Действие'},
      ]"
      :items="items"
    >
      <template v-slot:control="{ item }">
        <div class="btn-control">
          <Btn @click="onClickEdit(item.id)" class="info">Изменить</Btn>
          <Btn @click="onClickRemove(item.id)" class="danger">Удалить</Btn>
        </div>
      </template>
    </Table>
    <router-link :to="{ name: 'SportsmansEdit' }">
      <Btn class="list__create info ">Создать</Btn>
    </router-link>
  </div>
</template>

<script>
import { useStore } from 'vuex';
import { computed, onMounted } from 'vue';
import { useRouter } from 'vue-router';

import {
  selectSportsmanItems,
  removeSportsmanItem,
  fetchSportsmanItems,
  fetchSportsmanFilteredItems
} from '@/store/sportsmans/selectors';
import Table from '@/components/Table/Table';
import Btn from '@/components/Btn/Btn';

export default {
  name: 'SportsmansList',
  components: {
    Table,
    Btn,
  },
  props: {
    filter_field: String,
    filter_value: String,
  },
  setup(props) {
    const store = useStore();
    const router = useRouter();

    onMounted(() => {
      !!(props.filter_value) ? fetchSportsmanFilteredItems(store, props.filter_field, props.filter_value.toString()) : fetchSportsmanItems(store);
    });

    return {
      items: computed(() => selectSportsmanItems(store)),
      onClickRemove: id => {
        const isConfirmRemove = confirm('Вы действительно хотите удалить запись?')
        if (isConfirmRemove) {
          removeSportsmanItem(store, id)
        }
      },
      onClickEdit: id => {
        router.push({ name: 'SportsmansEdit', params: { id } })
      }
    }
  }

}
</script>
