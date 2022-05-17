export const fetchSportsmanItems = (store) => {
  const { dispatch } = store;
  return dispatch('sportsmans/fetchItems');
};

export const fetchSportsmanItemsById = (store, id) => {
  const { dispatch } = store;
  return dispatch('sportsmans/fetchFilteredItems', {'filter_field': 'id', 'filter_value': id});
};

export const fetchSportsmanFilteredItems = (store, filter_field, filter_value) => {
  const { dispatch } = store;
  return dispatch('sportsmans/fetchFilteredItems', {filter_field, filter_value});
};

export const selectSportsmanItems = (store, type_id = '') => {
  const { getters } = store;
  return  !!(type_id) ? getters['sportsmans/itemsByKey'][type_id] || {} : getters['sportsmans/items'];
}

export const removeSportsmanItem = (store, id) => {
  const { dispatch } = store;
  return dispatch('sportsmans/removeItem', id);
}

export const addSportsmanItem = (store, sportsman) => {
  const { dispatch } = store;
  return dispatch('sportsmans/addItem', sportsman);
}

export const updateSportsmanItem = (store, sportsman) => {
  const { dispatch } = store;
  return dispatch('sportsmans/updateItem', sportsman);
}

