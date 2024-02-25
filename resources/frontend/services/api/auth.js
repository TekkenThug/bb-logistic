import axios from "axios";

export const getCSRF = () => {
  return axios.get('/sanctum/csrf-cookie')
}

export const login = (data) => {
  return axios.post('/auth/login', data).then(({ data }) => data);
}