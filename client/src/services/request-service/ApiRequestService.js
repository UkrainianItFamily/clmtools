import axios from 'axios';
import router from '@/router';

const API_URL = process.env.VUE_APP_API_URL;

axios.interceptors.response.use(
  response => response,
  error => {
    const allError = error?.response?.data?.error;

    const nextError = new Error(allError?.message || error);

    nextError.response = error.response;
    return Promise.reject(nextError);
  }
);
const requestService = {
  get(url, params = {}, headers = {}) {
    return axios.get(API_URL + url, {
      params,
      headers
    });
  },
  post(url, body = {}, config = {}) {
    return axios.post(API_URL + url, body, config);
  },
  put(url, body = {}, config = {}) {
    return axios.put(API_URL + url, body, config);
  },
  patch(url, body = {}, config = {}) {
    return axios.patch(API_URL + url, body, config);
  },
  delete(url, config = {}) {
    return axios.delete(API_URL + url, config);
  }
};

export default requestService;
