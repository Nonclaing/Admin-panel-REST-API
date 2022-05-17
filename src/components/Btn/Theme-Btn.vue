<template>
    <div class="theme-btn">
      <label>
        <input
            v-model="themeMode"
            @change="changeTheme"
            type="checkbox"
            :checked="themeMode"
        >
        <span class="theme-btn__slider"></span>
      </label>
    </div>
</template>

<script>
import {ref, inject} from "vue";

export default {
  name: 'theme-btn',
  setup(props, { emit }) {
    const mode = inject('mode');

    const themeMode = ref(mode === 'dark');
    function changeTheme() {
      emit('changeTheme', {
        theme: themeMode.value,
      })
    }

    return {
      themeMode,
      changeTheme,
    }
  }
}
</script>
<style lang="scss" scoped>
@import "@/assets/styles/utils/yars.scss";
@import "@/assets/styles/thems/dark.scss";
.theme-btn {
  label {
    cursor: pointer;
    position: relative;
    display: inline-block;
    width: 70px;
    height: 34px;

    &:hover {
      &:before {
        animation: full-rotate infinite 5s linear;
      }
    }
    @keyframes full-rotate {
      0% {
        transform: translate(0, -50%) rotate(0deg);
      }
      50% {
        transform: translate(0, -50%) rotate(180deg);
      }
      100% {
        transform: translate(0, -50%) rotate(360deg);
      }
    }
    &:before, &:after {
      z-index: 3;
      position: absolute;
      content: "";
      top: 50%;
      width: 2.5rem;
      height: 2.5rem;
      transform: translate(0, -50%);
    }

    &:before {
      left: 5%;
      background: url("@/assets/icons/sun.svg") 0 0 no-repeat;
      background-size: contain;
    }

    &:after {
      right: 5%;
      background: url("@/assets/icons/moon.png") 100% 0 no-repeat;
      background-size: contain;
    }
  }

  input {
    opacity: 0;
    width: 0;
    height: 0;

    &:checked + .theme-btn__slider {
      background-color: #ccc;

      &:before {
        background-color: #111111;
        transform: translateX(3.6rem);
      }
    }
  }

  .theme-btn__slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #2c3e50;
    -webkit-transition: .4s;
    transition: .4s;
    border-radius: 3.4rem;

    &:before {
      position: absolute;
      content: "";
      height: 2.6rem;
      width: 2.6rem;
      left: .4rem;
      bottom: .4rem;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
      border-radius: 50%;
    }
  }
}
</style>
