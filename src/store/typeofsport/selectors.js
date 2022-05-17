export const fetchTypeOfSportItems = ( store ) => {
  const { dispatch } = store;
  return dispatch('typeofsport/fetchItems');
};

export const fetchTypeOfSportFilteredItems = (store, filter_field, filter_id) => {
  const { dispatch } = store;
  return dispatch('typeofsport/fetchFilteredItems', { filter_field, filter_id });
};

export const selectTypeOfSportItems = ( store ) => {
  const { getters } = store;
  return getters['typeofsport/items']
}

export const selectTypeOfSportItemById = (store, id) => {
  const { getters } = store;
  return getters['typeofsport/itemsByKey'][id] || {};
}

export const removeTypeOfSportItem = ( store, id ) => {
  const { dispatch } = store;
  return dispatch('typeofsport/removeItem', id);
}

export const addTypeOfSportItem = ( store, { name } ) => {
  const { dispatch } = store
  return dispatch('typeofsport/addItem', { name });
}

export const updateTypeOfSportItem = ( store, { id, name }) => {
  const { dispatch } = store;
  return dispatch('typeofsport/updateItem', { id, name });
}
