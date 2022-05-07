import Api from './index';

export default {
    add_event(form){
        return Api().post('/add-event',form)
    },
    list_events(){
        return Api().get('/events')
    },
    create_tickets(form){
        return Api().post('/create-event-ticket',form)
    },
    get_event_tickets(id){
        return Api().get('/get-event-tickets/'+id)
    }
}