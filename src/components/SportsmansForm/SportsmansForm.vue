<template>
  <div class="form">
    <div v-if="form.id" class="form__item">
      <div class="form__label">
        <label for="id">ID</label>
      </div>
      <v-input
          disabled
          id="id" placeholder="id" type="text"
          v-model="form.id"
          :insert="form.id"
      />
    </div>
    <div class="form__item">
      <div class="form__label">
        <label for="name">ФИО</label>
      </div>
      <v-input
          id="name" placeholder="ФИО" type="text"
          v-model="form.name"
          :insert="form.name"
      />
    </div>
    <div class="form__item">
      <div class="form__label">
        <label for="photo">Фотография</label>
      </div>
      <v-file
          id="photo"
          :title="'Фотография'"
          :placeholder="'Фотография'"
          :name="'photo'"
          :value="form.photo"
          @changeFile="previewFiles"
          @clear="clearFile"
      />
    </div>
    <div class="form__item">
      <div class="form__label">
        <label for="type_of_sport_id">Вид спорта</label>
      </div>
      <v-input
          name="type_of_sport_id" id="type_of_sport_id" type="select"
          v-model="form.type_sport.id"
          :selectID="form.type_sport.id"
          :list="typeOfSportList"
          :list-field="'name'"
      />
    </div>
    <div class="form__item">
      <div class="form__label">
        <label for="biography">Биография</label>
      </div>
      <v-input
          id="biography"
          placeholder="Биография"
          type="textarea"
          v-model="form.biography"
          :insert="form.biography"
      />
    </div>
    <div class="form__item">
      <div class="form__label">
        <label for="year">Год начала карьеры</label>
      </div>
      <v-input
          id="year" placeholder="Год" type="date"
          v-model="form.year"
          :insert="form.year"
      />
    </div>
    <div class="form__item">
      <Btn @click="onClick" :disabled="!isValidForm" class="info">Сохранить</Btn>
      <img class="upload-image" :style="{transform: 'rotate(' + angle +  'deg)'}" v-if="uploadWait" src="@/assets/icons/loading_icon_149916.svg" alt="">
    </div>
  </div>
</template>

<script>
import { useStore } from 'vuex';
import { computed, reactive, onBeforeMount, watchEffect, ref } from 'vue';
import { useRouter } from 'vue-router';

import {
  addSportsmanItem,
  updateSportsmanItem,
  fetchSportsmanItemsById, selectSportsmanItems
} from '@/store/sportsmans/selectors';
import {selectTypeOfSportItems, fetchTypeOfSportItems} from '@/store/typeofsport/selectors'
import Btn from '@/components/Btn/Btn';
import VFile from "@/components/File/File";
import {fetchUploadFiles, selectUploadFiles} from "@/store/files/selectors";
import VInput from "@/components/Input/Input";


export default {
  name: 'SportsmansForm',
  props: {
    id: { type: String, default: '' },
  },
  components: {
    VInput,
    VFile,
    Btn,
  },
  setup(props, context) {
    const store = useStore();
    const router = useRouter();
    const form = reactive({
      id: '',
      name: '',
      photo: '',
      type_sport: {
        id: '',
        name: ''
      },
      biography: '',
      year: '',
    });

    const fileData = ref('');
    let formPhoto = "";

    const angle = ref(0);
    let timer = ref(0);
    let uploadWait = ref(false);

    onBeforeMount(() => {
      fetchSportsmanItemsById(store,  props.id);
      fetchTypeOfSportItems(store);
      if (uploadWait)
        timer =  setInterval(rotateImage, 100);
    });

    watchEffect(() => {
      const Sportsman = selectSportsmanItems(store, props.id );
      Object.keys(Sportsman).forEach(key => {
        form[key] = Sportsman[key];
      })
      if (formPhoto == "" && form.id)
        formPhoto = form.photo;
    });

    const isValidForm = computed(() => {
      for (const [key, value] of Object.entries(form)) {
        if (typeof value == 'object' && !(value.id)) return false;
        if (key !== 'id' && !(value)) return false;
      }
      return true
    });

    function rotateImage() {
      angle.value += 45;
      if (angle.value >= 360)
        angle.value = 0;
    }

    async function uploadFile() {
      const res = await fetchUploadFiles(store, fileData.value);
      const file = await selectUploadFiles(store);
      return file;
    }

    async function makeQuery(form) {
      const res = form.id ? await updateSportsmanItem(store, form) : await addSportsmanItem(store, form);
      return res;
    }

    return {
      form, isValidForm, formPhoto, uploadWait, angle, fileData,
      typeOfSportList: computed(() => selectTypeOfSportItems(store)),
      previewFiles: (e) => {
        fileData.value = e.target.files[0];
        form[`${e.target.id}`] = `${e.target.files[0].name}`;
      },
      clearFile: (e) => {
        form.photo = e;
      },
      onClick: async () => {
        if (formPhoto != form.photo) {
          uploadWait.value = true;
          const file = await uploadFile().then((response) => {
            return {...response};
          });
          uploadWait.value = false;

          if (file.file_path) {
            form.photo = file.file_path;
            await makeQuery(form).then(() => router.push({name: 'Sportsmans'}))
          }
        }
        else
          await makeQuery(form).then(() => router.push({name: 'Sportsmans'}))

      }
    }
  },
}
</script>
