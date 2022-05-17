<template>
  <div class="app" :class="mode">
    <div class="wrapper">
      <v-header @changeTheme="changeTheme"/>
      <div class="wrapper__content">
        <main class="main">
          <div class="container">
            <div class="main__content">
              <router-view/>
            </div>
          </div>
        </main>
      </div>
      <v-footer/>
    </div>
  </div>
</template>
<script>
import ListTables from "@/views/ListTables";
import VHeader from "@/components/Header/Header";
import VFooter from "@/components/Footer/Footer";
import {ref, provide} from "vue";
export default {
  components: {VFooter, VHeader, ListTables},
  setup() {
    const mode = ref('light');
    provide('mode', mode);

    function changeTheme(item) {
      mode.value = item.theme ? 'dark' : 'light';
    }
    
    return {
      mode,
      changeTheme,
    }
  }
}
</script>
<style  lang="scss">
@import "./assets/styles/main";
</style>