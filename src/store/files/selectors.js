export const fetchUploadFiles = ( store, file ) => {
  const { dispatch, getters } = store;
  return dispatch('files/uploadFiles', file);
};

export const selectUploadFiles = ( store) => {
  const { getters } = store;
  return  getters['files/items'];
}