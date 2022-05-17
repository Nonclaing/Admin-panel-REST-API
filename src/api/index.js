class Api {
  constructor() {
    this.base = 'http://lab3-web/rest';
  }

  request = async (method, options) => {
    const url = this.base + method;
    return fetch(url, {...options, mode: 'cors'});
  }

  rest = async (method, options) => {
    return this.request(method, options)
        .then((data) => data)
  }
}
export default Api;

