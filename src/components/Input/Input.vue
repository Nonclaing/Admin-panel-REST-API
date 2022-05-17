<template>
  <textarea
      v-if="type == 'textarea'"
      v-model="value"
      class="input" :class="['input_' + type]"
      :placeholder="placeholder"
  />
  <select
      v-else-if="type == 'select'"
      class="input" :class="['input_' + type]"
      v-model="selected"
  >
    <option v-for="item in list" :key="item.id" :value="item.id" >
      {{ item[listField] }}
    </option>
  </select>
  <input
      v-else-if="type == 'file'"
      v-model="value"
      class="input" :class="['input_' + type]"
      :placeholder="placeholder"
      :type="type"
  />
  <input
      v-else
      v-model="value"
      class="input" :class="['input_' + type]"
      :placeholder="placeholder" :type="type"
  />
</template>

<script>
import {ref, watchEffect} from "vue";

export default {
  name: 'VInput',
  props: {
    placeholder: String,
    type: String,
    insert: String,
    list: Array,
    selectID: String | Number,
    listField: String,
  },
  setup(props) {
    const value = ref();
    const selected = ref(props.selectID);

    watchEffect(() => {
      value.value = props.insert
      selected.value = props.selectID;
    })

    return {
      value,
      selected,
    }
  }
}
</script>
<style lang="scss" scoped>
@import "@/assets/styles/utils/yars.scss";
@import "@/assets/styles/thems/dark.scss";
@import "@/assets/styles/thems/light.scss";

.input {
  display: block;
  width: 100%;

  padding: 0.8rem 1rem;

  font-size: 1.6rem;
  line-height: 1.5;
  color: $light-input-color;

  background-color: $light-input-bg;
  border: .1rem solid $light-input-border;
  border-radius: 0.4rem;

  transition: $themeTransition;

  &:focus {
    border-color: $light-input-focus;
  }

  &.input_text {
    background-clip: padding-box;
  }

  &.input_textarea {
    resize: vertical;
    min-height: 4rem;
  }

  &.input_select {

    -moz-padding-start: calc(0.75rem - .3rem);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1.6rem 1.2rem;
    appearance: none;
  }

  &.input_date {

  }

  &.input_file {
    cursor: pointer;

    background-clip: padding-box;

    &::file-selector-button {
      cursor: pointer;
    }
  }
}

.dark {

  .input {
    color: $dark-text;
    background-color: $dark-bg-form;
    border-color: $dark-form-border;

    &:focus {
      border-color: $dark-input-focus;
    }

    &.input_select {
      background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'><path fill='none' stroke='%23e7e5e5' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/></svg>");
    }

    &.input_date {
      &::-webkit-calendar-picker-indicator {
        filter: invert(100%);
      }
    }

    &.input_file {
      &::file-selector-button {
        color: $dark-text;

        background-color: $dark-bg-second;
        border-color:  $dark-text;
      }
    }
  }
}
</style>