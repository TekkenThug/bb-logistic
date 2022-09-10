import http from "../libs/http";

export const getCSRF = () => {
  return http.get('/sanctum/csrf-cookie')
}

export const login = (data) => {
  return http.post('/auth/login', data).then(({ data }) => data);
}