<template>
  <div class="file">
    <div class="file__body">
      <div class="file__control">
        <div class="file__choose">
          <div class="file__name">
            <span v-if="value">{{value.replace('/files/', '')}}</span>
            <span v-else>Файл не выбран</span>
          </div>
            <v-input
                :id="name" :placeholder="placeholder" type="file"
                @input="previewFiles"  ref="fileInput"
            />
        </div>
        <div class="file__clear-button">
          <button @click="clearFile">
            <span>&#10006;</span>
          </button>
        </div>
      </div>
      <div class="file__preview">
        <VImage
            :photo="previewPhoto"
            :alt="'Превью фота'"
        />
      </div>
    </div>
  </div>
</template>

<script>
import {computed, onBeforeMount, ref, watchEffect} from "vue";
import VImage from "@/components/Image/Image";
import VInput from "@/components/Input/Input";
export default {
  name: 'VFile',
  components: {VInput, VImage},
  props: {
    title: String,
    name: String,
    placeholder: String,
    value: String,
  },
  setup(props, context) {
    let originFile = null;
    const fileInput = ref(null);
    const previewPhoto = ref('')

    watchEffect(() => {
      if (props.value !== '' && previewPhoto.value === '')
        previewPhoto.value = 'http://lab3-web/' + props.value;
      if (originFile == null)
        originFile = props.value
    })

    function previewFiles(e) {
      if (e.target.files[0]) {
        previewPhoto.value = URL.createObjectURL(e.target.files[0])
        context.emit('changeFile', e);
      }
    }

    function clearFile() {
      fileInput.value.value = '';
      previewPhoto.value = 'http://lab3-web/' + originFile;
      context.emit('clear', originFile);
    }

    return {
      previewFiles,
      clearFile,
      fileInput,
      previewPhoto,
      originFile,
    }
  }
}
</script>

<style lang="scss" scoped>
@import "@/assets/styles/utils/yars.scss";
@import "@/assets/styles/thems/dark.scss";
@import "@/assets/styles/thems/light.scss";

.file {
  position: relative;
  display: flex;
  align-items: center;
  flex: 1 1 100%;

  .file__body {
    display: flex;
    flex-direction: column;
    flex: 1 1 100%;
    &>*:not(:last-child) {
      margin-bottom: .5rem;
    }
  }

  .file__control {
    display: flex;
    &>*:not(:last-child) {
      margin-right: .5rem;
    }
  }

  .file__choose {
    display: flex;
    flex-direction: column;
    flex: 1 1 auto;
    &>*:not(:last-child) {
      margin-bottom: .5rem;
    }
  }

  .file__clear-button {
    display: flex;
    background-color: $light-red;
    color: $light-bg-main;
    border-radius: .3rem;
    align-self: end;
    transition: $themeTransition;

    &:hover {
      background-color: $light-red-hover;
    }

    a, button {
      background-color: inherit;
      border: inherit;
      color: inherit;
      cursor: pointer;
      transition: inherit;
      padding: .8rem;
      border: .1rem solid $light-red;

      &:focus {
        border-color: $dark-bg-main;
      }
    }
  }

  .file__preview {

  }
}

.dark {
  .file {

    .file__clear-button {
      background-color: $dark-bg-button-danger;
      color: $dark-text;

      &:hover {
        background-color: $dark-bg-button-danger-hover;
      }

      a, button {
        border-color: $dark-bg-button-danger;
        &:focus {
          border-color: $dark-text;
        }
      }
    }
  }
}

</style>