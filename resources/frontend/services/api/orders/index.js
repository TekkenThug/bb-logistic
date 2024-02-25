import { API } from "@/services/api";

export const getOrders = async (params) => {
    return await API.get("/orders", { params });
}

export const updateOrder = async (id, params = {}) => {
    return await API.patch(`/orders/${id}`, { params });
};