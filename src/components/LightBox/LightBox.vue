<template>
  <div class="table__img-link">
    <div class="light-box">
      <img v-for="image in images"
           class="light-box__img"
           alt="404"
           :src="image"
           @click="() => showImg(image)"
      >
      <vue-easy-lightbox
          :visible="visible"
          :imgs="imgs"
          @hide="visible = false"
      />
    </div>
  </div>
</template>

<script>
import {ref} from "vue";

export default {
  name: 'light-box',
  props: {
    images: Array,
  },
  setup(props) {
    const imgs = ref('');
    const visible = ref(false);
    return {
      visible,
      imgs,
      showImg(url) {
        this.imgs = url
        this.visible = true
      }
    }
  },
}
</script>

<style lang="scss" scoped>
.light-box {
  width: 10rem;
  height: 10rem;

  .light-box__img {
    transition: .4s ease;
    width: 100%;
    height: 100%;
    object-fit: contain;

    &:hover {
      cursor: pointer;
      transform: scale(1.2);
    }
  }
}
</style>