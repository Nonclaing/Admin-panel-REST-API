import api from './api';

export default {
  namespaced: true,
  state: {
    items: [],
  },
  getters: {
    items: state => state.items,
  },
  mutations: {
    setItems: (state, items) => {
      state.items = items;
    }
  },
  actions: {
    uploadFiles: async ({ commit }, files) => {
      const fileData = new FormData()
      fileData.append('file',files)
      const response = await api.uploadFile(fileData);
      if (!response.error.error)
        commit('setItems', response.item)
      else
      {
        alert(response.error.error_message);
        throw new Error(response.error.error_message);
      }
    }
  },
}
