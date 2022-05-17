import { createStore } from 'vuex'
import sportsmans from './sportsmans';
import typeofsport from './typeofsport';
import files from './files';
export default createStore({
  modules: {
    sportsmans,
    typeofsport,
    files,
  },
  state: {},
  mutations: {},
  actions: {},
})
