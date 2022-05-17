<template>
  <header class="header">
    <div class="container">
      <div class="header__content">
        <navbar :links="links"></navbar>
        <theme-btn
            @changeTheme="changeTheme"
            class="header__content-item header__content-item_end">
        </theme-btn>
      </div>
    </div>
  </header>
</template>

<script>
import Navbar from "@/components/Navbar/Navbar";
import ThemeBtn from "@/components/Btn/Theme-Btn";
import {computed, ref} from "vue";
export default {
  name: 'v-header',
  components: {ThemeBtn, Navbar},
  setup(props, { emit }) {
    const links = [
      {
        name: 'SportClub',
        text: 'SportClub',
      },
      {
        name: 'Sportsmans',
        text: 'Спортсмены',
      },
      {
        name: 'TypeOfSport',
        text: 'Виды спорта',
      },
    ];

    function changeTheme(item) {
      emit('changeTheme', {
        theme: item.theme
      })
    }

    return {
      changeTheme,
      links,
    }
  }
}
</script>
