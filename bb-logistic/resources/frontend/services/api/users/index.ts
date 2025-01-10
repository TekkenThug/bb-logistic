import instance from '../instance';

export const createUser = async (data) => {
    return (await instance.post('/users', data))
}