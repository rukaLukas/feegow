import axios from 'axios';

axios.interceptors.request.use(
  (config) => {
    // @ts-ignore
    config.headers['X-Requested-With'] = 'XMLHttpRequest';
    config.baseURL = 'http://localhost:8181/api'//process.env.VUE_APP_API_BASEURL;
    return Promise.resolve(config);
  },
  (error) => {
    Promise.reject(error)
  },
);

axios.interceptors.response.use(
  (response) => response.data,
  async (error) => {    
    return Promise.reject(error.response)
  }
);
