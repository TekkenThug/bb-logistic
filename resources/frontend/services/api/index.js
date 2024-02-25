import axios from "axios";

import api from "./api";
import stock from "./stock";

export default {
    common: api(),
    stock: stock()
}

const API = axios.create({ baseURL: "/api" });

export {
    API,
}
