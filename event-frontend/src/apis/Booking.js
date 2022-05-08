import Api from './index';

export default {
    create_booking(form){
        return Api().post('/add-booking',form)
    },
    list_booking(){
        return Api().get('/bookings')
    },
    show_booking(id){
        return Api().get('/get-booking/'+id);
    },
    remove_booking(id){
        return Api().get('/remove-booking/'+id)
    }
    
}