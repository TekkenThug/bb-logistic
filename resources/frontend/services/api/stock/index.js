import { API } from "@/services/api";

export const getStockProducts = async (id) => {
    return await API.get(`/stock/${id}`);
}