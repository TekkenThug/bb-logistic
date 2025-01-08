import instance from "../instance"

export const getCSRF = () => {
    return instance.get('/sanctum/csrf-cookie')
}

export const login = async (data) => {
    return (await instance.post('/login', data)).data;
}