import Api from './index';

export default {
    create_booking(form){
        return Api().post('/add-booking',form)
    },
    list_booking(){
        return Api().get('/bookings')
    },
    
}