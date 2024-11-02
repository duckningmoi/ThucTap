import axios from 'axios'

// const instance = axios.create({
//     // baseURL: import.meta.env.VITE_BASE_URL
//     baseURL: 'http://localhost:3000'
// })
// export default instance
const axiosInstance = axios.create({

    baseURL: "http://localhost:8000/api", // URL API của Laravel
});
export default axiosInstance;
