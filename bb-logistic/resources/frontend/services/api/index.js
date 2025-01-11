import axios from 'axios';
import stock from './old-stock';

export default {
    stock: stock()
};

const API = axios.create({ baseURL: '/api' });

export {
    API,
};
