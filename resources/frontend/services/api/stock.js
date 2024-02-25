export default function () {
    return {
        getProducts(id) {
            return axios.get(`/stock/${id}`).then(res => res.data.stock);
        },
        createProduct(id, data) {
            data.ownerId = id;
            return axios.post('/stock', data).then(res => res.data.status);
        },
        updateProduct(data, id) {
            return axios.patch(`/stock/${id}`, data).then(res => res.data.status);
        },
        deleteProducts(id, product) {
            return axios.delete(`/stock/${id}`, {product});
        }
    }
}
