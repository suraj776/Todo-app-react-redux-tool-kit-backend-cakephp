import axios from 'axios';

const headers={
    // 'Content-Type':'application/form-data',
    // 'Access-Control-Allow-Origin':'*'
  }
const axiosInstance = axios.create({
    headers:headers
});

axiosInstance.interceptors.request.use(
  (config) => {
    if (localStorage.getItem('token')!=='') {
      config.headers['Authorization'] = "Bearer "+localStorage.getItem('token') || '';
    }
    return config;
  },
  (error) => Promise.reject(error)
);

axiosInstance.interceptors.response.use(
  (response) => response,
  (error) => {
    // Handle errors
    if (error.response) {
      console.error('Response error:', error.response.data);
      return Promise.reject(error.response.data);
    } else if (error.request) {
      console.error('Request error:', error.request);
    } else {
      console.error('Error message:', error.message);
    }
    return Promise.reject(error);
  }
);

const ApiRequestHandler = {
  get: (api, additionalHeaders = {}) => axiosInstance.get(api+".json", { headers: { ...additionalHeaders } }),
  post: (api, data, additionalHeaders = {}) => axiosInstance.post(api+".json", data, { headers: { ...additionalHeaders } }),
  put: (api, data, additionalHeaders = {}) => axiosInstance.put(api+".json", data, { headers: { ...additionalHeaders } }),
  delete: (api, additionalHeaders = {}) => axiosInstance.delete(api+".json", { headers: { ...additionalHeaders } }),
};

export default ApiRequestHandler;
