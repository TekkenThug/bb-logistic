import instance from '../instance';

type Client = {
    id: number;
    first_name: string;
    last_name: string;
    address: string;
    email: string;
}

export const getAll = async (): Promise<Client[]> => {
    const { data } = await instance.get('/clients');

    return data.data
}