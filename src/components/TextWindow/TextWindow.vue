<template>
  <div>
    <btn
        class="link"
        @click="showText"
    >
      {{button_text}}
    </btn>
    <div @click="showText" :class="{hidden: isHidden}" class="window-message">
      <a class="window-message__exit-button">X</a>
      <div :class="{hidden: isHidden}" class="window-message__body">
        <slot/>
      </div>
    </div>
  </div>
</template>

<script>
import Btn from "@/components/Btn/Btn";
import {ref} from "vue";

export default {
  name: "TextWindow",
  components: {Btn},
  props: {
    button_text: String,
    text: String
  },
  setup(props) {
    const isHidden = ref(true);

    function showText(event) {
      if (!event.target.classList.contains('window-message__body') || event.target.classList.contains('link')) {
        document.body.classList.toggle('lock');
        isHidden.value = !isHidden.value;
      }
    }

    return {
      isHidden,
      showText,
    }
  }
}
</script>

<style lang="scss" scoped>
@import "@/assets/styles/utils/yars.scss";
@import "@/assets/styles/thems/dark.scss";
@import "@/assets/styles/thems/light.scss";

.window-message {
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 50;
  width: 100%;
  height: 100%;
  background-color: rgba(55, 55, 55, 0.5);

  &.hidden {
    visibility: hidden;

  }

  .window-message__exit-button {
    display: block;
    position: absolute;
    top: 0;
    right: 2.0rem;

    cursor: pointer;
    color: $dark-text;
    font-size: 4rem;

    transition: $themeTransition;

    -ms-user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;

    &:hover {
      color: red;
    }

  }

  .window-message__body {
    position: absolute;
    top: 10%;
    left: 50%;

    overflow-y: auto;
    overflow-x: hidden;
    width: 80%;
    height: 80%;

    padding: 1rem;
    text-align: left;
    white-space: pre-wrap;
    color: black;
    background-color: white;

    transform: translate(-50%, 0) scale(1);
    transition: all 0.3s;
    opacity: 1;

    &.hidden {
      transform: translate(-50%, 0) scale(0);
      opacity: 0;
    }
  }

}

.dark {
  .window-message {

    .window-message__exit-button {
      &:hover {
        color: $dark-bg-button-danger-hover;
      }
    }

    .window-message__body {
      color: $dark-text;
      background-color: $dark-bg-main;
    }
  }
}
</style>