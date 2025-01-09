import instance from "@/services/api/instance"

export const getCSRF = () => {
    return instance.get('/sanctum/csrf-cookie')
}

export const login = async (data: { email: string, password: string }) => {
    return (await instance.post('/login', data)).data;
}

export const me = async () => {
    return (await instance.get('/me')).data
}

export const logout = async () => {
    return await instance.post('/logout')
}