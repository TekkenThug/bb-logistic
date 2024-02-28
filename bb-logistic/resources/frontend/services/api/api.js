export default function () {
    return {
         getClients() {
             return axios.get('/clients').then(res => { return res.data.clients });
        }
    }
}
