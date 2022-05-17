<template>
  <div class="navbar">
    <RouterLink v-for="item in links" :to="{name: item.name}">{{ item.text }}</RouterLink>
  </div>
</template>

<script>
export default {
  name: 'navbar',
  props: {
    links: Array,
  }
}
</script>
<style lang="scss" scoped>
@import "@/assets/styles/utils/yars.scss";
@import "@/assets/styles/thems/dark.scss";
@import "@/assets/styles/thems/light.scss";

.navbar {
  padding: 1.5rem;
  a {
    font-weight: bold;
    color: $light-dark-blue;
    text-decoration: none;
    transition: all .3s ease;

    &:not(:last-child) {
      margin-right: .8rem;
    }

    &:hover {
      color: $light-green;
    }

    &.router-link-exact-active {
      color: $light-green-hover;
    }
  }
}

.dark {
  .navbar {
    a {
      color: $dark-nav-link;

      &:hover {
        color: $dark-nav-link-hover;
      }

      &.router-link-exact-active {
        color: $dark-nav-link-active;
      }
    }
  }
}
</style>