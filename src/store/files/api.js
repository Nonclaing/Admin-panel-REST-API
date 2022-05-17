import Api from '@/api/index';

class Files extends Api {
  uploadFile = (file) => this.rest('/file/upload', {
    method: 'POST',
    'Content-Type': 'multipart/form-data',
    body: file,
  }).then((response) => response.json()).then((resJson) => resJson);

}

export default new Files();
