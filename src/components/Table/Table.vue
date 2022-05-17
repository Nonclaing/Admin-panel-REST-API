<template>
  <div class="table">
    <table v-if="items.length">
      <thead class="table__head">
        <tr class="table__row">
          <th  v-for="{ value, text, type } in headers" :key="value">
            <div class="table__sort" v-if="value !== 'control'">
              <span @click="sortBy = sortItems(value)">{{ text }}</span>
            </div>
            <div v-else>
              <span>{{ text }}</span>
            </div>
          </th>
      </tr>
      </thead>
      <tbody class="table__body">
        <tr v-for="(item, indx) in sortedItem" :key="indx">
          <td v-for="(key, idx) in colKeys" :key="idx">
            <slot :name="key" v-bind="{ item }">
              <div v-if="'array' ===  colTypes[idx]">
                {{ item[key][headers[idx].field] }} ({{ item[key].id }})
              </div>
              <div v-else-if="'link' === colTypes[idx]">
                <text-window
                    :button_text="'Подробнее'"
                    :text="item[key]"
                >
                  {{item[key]}}
                </text-window>
              </div>
              <div v-else-if="'img' === colTypes[idx]">
                <light-box :images="['http://lab3-web' + item[key]]"/>
              </div>
              <span v-else >
                 {{ item[key] }}
              </span>
            </slot>
          </td>
        </tr>
      </tbody>
    </table>
    <div v-else>
      <div class="table__not-found">
        Элементы не найдены
      </div>
    </div>
  </div>
</template>

<script>

import {computed, ref} from "vue";
import Btn from "@/components/Btn/Btn";
import {useRouter} from "vue-router";
import FsLightbox from "fslightbox-vue/v3";
import LightBox from "@/components/LightBox/LightBox";
import TextWindow from "@/components/TextWindow/TextWindow";
export default {
  name: 'Table',
  components: {TextWindow, LightBox, Btn, FsLightbox },
  props: {
    items: Array,
    headers: Array
  },
  setup(props) {
    const sortBy = ref('id');

    const sortedItem = computed( () => {
      let option = 1;
      let sort = sortBy.value;

      if (sortBy.value[0] === '-') {
        option = -1;
        sort = sort.slice(1);
      }

      return props.items.sort((a, b) => {
        if (a[sort] > b[sort]) return 1 * option;
        else return -1 * option;
      });
    })

    function sortItems(val) {
      return sortBy.value === val ? '-' + val : val;
    }

    function showText(btn) {

    }

    return {
      sortedItem, sortBy,
      sortItems, showText

    }
  },
  computed: {
    colKeys() {
      return this.headers.map(({ value }) => value);
    },
    colTypes() {
      return this.headers.map(({type}) => type);
    },

  }
}
</script>