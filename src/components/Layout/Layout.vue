<template>
  <div class="layout">
    <h1 v-if="title" class="layout__title">{{title}}</h1>
    <div class="layout__content">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  name: 'Layout',
  props: {
    title: { type: String }
  }
}
</script>
