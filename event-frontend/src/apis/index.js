import axios from 'axios';

let BaseApi = axios.create({
    baseURL : process.env.VUE_APP_API_URL,
})

let Api = function () {
    console.log("process ",process.env)
    let token = localStorage.getItem("token");
    if(token){
        BaseApi.defaults.headers.common['Authorization'] = 'Bearer '+token;
    }
    return BaseApi    
}

export default Api;