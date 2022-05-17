<template>
  <button :disabled="disabled" class="v-button">
    <slot />
  </button>
</template>

<script>
export default {
  name: 'Btn',
  props: {
    theme: String,
    disabled: Boolean,
  }
}
</script>
<style lang="scss" scoped>
@import "@/assets/styles/utils/yars.scss";
@import "@/assets/styles/thems/dark.scss";
@import "@/assets/styles/thems/light.scss";

.btn-control {
  &>*:not(:last-child) {
    margin-right: .8rem;
  }

}
.v-button {
  padding: 0.7rem 0.75rem;
  font-size: 1.7rem;
  border: .2rem solid transparent;
  border-radius: 0.25rem;
  color: $light-bg-main;
  cursor: pointer;
  transition: $themeTransition;

  &:focus {
    border-color: $dark-bg-main;
  }

  &.danger {
    background-color: $light-red;
    &:hover {
      background-color: $light-red-hover
    }
  }

  &.info {
    background-color: $light-blue;
    &:hover {
      background-color: $light-blue-hover
    }
  }

  &.link {
    background-color: $light-green;
    &:hover {
      background-color: $light-green-hover;
    }
  }

  &[disabled] {
    cursor: default;
    pointer-events: none;
    color: $light-disabled-color;
    border: 2px solid $light-disabled-border;
    background-color: $light-disabled-bg;
  }

}

.dark {
  .v-button {
    color: $dark-text;

    &[disabled] {
      color: $dark-text-button-disabled;
      border: 2px solid $dark-border-button-disabled;
      background-color: $dark-bg-main;
    }

    &:focus {
      border-color: $dark-text;
    }

    &.danger {
      background-color: $dark-bg-button-danger;
      &:hover {
        background-color: $dark-bg-button-danger-hover;
      }
    }

    &.info {
      background-color:$dark-bg-button-info;
      &:hover {
        background-color: $dark-bg-button-info-hover;
      }
    }

    &.link {
      background-color: $dark-bg-button-link;

      &:hover {
        background-color: $dark-bg-button-link-hover;
      }
    }
  }
}


</style>