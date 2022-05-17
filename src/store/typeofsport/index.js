import api from './api';

export default {
  namespaced: true,
  state: {
    items: [],
  },
  getters: {
    items: state => state.items,
    itemsByKey: state => state.items.reduce((res, cur) => {
      res[cur['id']] = cur;
      return res;
    }, {}),
  },
  mutations: {
    setItems: (state, items) => {
      state.items = items;
    },
    setItem: (state, item) => {
      state.items.push(item);
    },
    removeItem: (state, idRemove) => {
      state.items = state.items.filter(({ id }) => id !== idRemove);
    },
    updateItem: (state, updateItem) => {
      const index = state.items.findIndex(item => +item.id === +updateItem.id);
      state.items[index] = updateItem;
    }
  },
  actions: {
    fetchItems: async ({ commit }) => {
      const response = await api.typeOfSport();
      const items = await response.json();
      commit('setItems', items)
    },
    fetchFilteredItems: async ({ commit }, filter_field, filter_id) => {
      const response = await api.typeOfSportFiltered(filter_field, filter_id);
      const items = await response.json();
      commit('setItems', items);
    },
    removeItem: async ({ commit }, id) => {
      const response = await api.remove( id );
      if (!response.error.error)
        commit('removeItem', id);
      else
      {
        alert(response.error.error_message);
        throw new Error(response.error.error_message)
      }
      return response;
    },
    addItem: async ({ commit }, typeOfSport) => {
      const response = await api.add(typeOfSport);
      if (!response.error.error)
        commit('setItem', response.item);
      else
      {
        alert(response.error.error_message);
        throw new Error(response.error.error_message)
      }
      return response;
    },
    updateItem: async ({ commit }, typeOfSport) => {
      const response = await api.update(typeOfSport);
      if (!response.error.error)
        commit('updateItem', response.item);
      else
      {
        alert(response.error.error_message);
        throw new Error(response.error.error_message)
      }
      return response;
    }
  },
}
