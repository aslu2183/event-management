import Api from './index';

export default {
    list_dashboard(){
        return Api().get('/get-dashboard');
    }
}