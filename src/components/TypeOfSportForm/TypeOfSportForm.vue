<template>
  <div class="form">
    <div v-if="form.id" class="form__item">
      <div class="form__label">
        <label for="id">id</label>
      </div>
      <v-input
          disabled
          id="id" placeholder="id" type="text"
          :value="form.id"
          :insert="form.id"
      />
    </div>
    <div class="form__item">
      <div class="form__label">
        <label for="name">Вида спорта</label>
      </div>
      <v-input
          id="name" placeholder="Вид спорта" type="text"
          v-model="form.name"
          :insert="form.name"
      />
    </div>
    <div class="form__item">
      <Btn @click="onClick" :disabled="!isValidForm" class="info">Сохранить</Btn>
    </div>
  </div>
</template>

<script>
import { computed, reactive, onBeforeMount, watchEffect } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

import {
  selectTypeOfSportItemById,
  fetchTypeOfSportItems,
  updateTypeOfSportItem,
  addTypeOfSportItem
} from '@/store/typeofsport/selectors';
import Btn from '@/components/Btn/Btn';
import VInput from "@/components/Input/Input";
export default {
  name: 'TypeOfSportForm',
  components: {
    VInput,
    Btn,
  },
  props: {
    id: { type: String, default: '' },
  },
  setup(props, context) {
    const store = useStore();
    const router = useRouter();
    const form = reactive({
      id: '',
      name: '',
    });

    onBeforeMount(() => {
      fetchTypeOfSportItems(store);
    });

    watchEffect(() => {
      const TypeOfSport = selectTypeOfSportItemById( store,  props.id );
      Object.keys(TypeOfSport).forEach(key => {
        form[key] = TypeOfSport[key]
      })
    });

    async function makeQuery(id, name) {
      const res = id ? await updateTypeOfSportItem(store, { id, name }) : await  addTypeOfSportItem(store,{ name })
      return res;
    }

    return {
      form,
      isValidForm: computed(() =>  !!(form.name)),
      onClick:  async () => {
        const res = await makeQuery(form.id, form.name);
        if (!res.error.error)
          await router.push({name: 'TypeOfSport'})
      },
    }
  }
}
</script>