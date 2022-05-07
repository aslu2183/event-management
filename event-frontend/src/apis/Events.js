import Api from './index';

export default {
    add_event(form){
        return Api().post('/add-event',form)
    },
    list_events(){
        return Api().get('/events')
    }
}