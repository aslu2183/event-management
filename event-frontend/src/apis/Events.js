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
    },
    get_report_based_on_events(form){
        return Api().post('/get-report-based-on-events',form)
    },
    get_report_based_on_tickets(form){
        return Api().post('/get-report-based-on-tickets',form)
    },
    get_tickets(){
        return Api().get('/get-tickets');
    },
    remove_tickets(id){
        return Api().get('/remove-tickets/'+id)
    },
    remove_event(id){
        return Api().get('/remove-event/'+id)
    }

}