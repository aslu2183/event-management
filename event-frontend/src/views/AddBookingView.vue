<template>
    <CRow class="justify-content-center">
        <CCol :xs="12" :lg="6" :md="12" :sm="12" >
            <CCard class="mb-4">
                <CCardHeader>
                  <strong>Add New Booking</strong>
                </CCardHeader>
                <CCardBody>
                    <CForm>
                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlInput1">Name</CFormLabel>
                            <CFormInput type="text" id="exampleFormControlInput1" placeholder="Name of Person" v-model="form.booking_person"/>
                            <span class="error" v-if="errors.booking_person">{{ errors.booking_person[0] }}</span>
                        </div>
                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlTextarea1">Email Id</CFormLabel>
                            <CFormInput type="email" id="exampleFormControlInput1" placeholder="Email ID" v-model="form.booking_email"/>
                            <span class="error" v-if="errors.booking_email">{{ errors.booking_email[0] }}</span>
                        </div>
                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlTextarea1">Mobile Number</CFormLabel>
                            <CFormInput type="text" id="exampleFormControlInput1" placeholder="Mobile" v-model="form.booking_mobile"/>
                            <span class="error" v-if="errors.booking_mobile">{{ errors.booking_mobile[0] }}</span>
                        </div>
                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlTextarea1">Choose an Event</CFormLabel>
                            <CFormSelect
                                v-model="form.booking_event"
                                @change="getTickets">
                                <option v-for="event in events" :key="event.value" :value="event.value">
                                    {{ event.label }}
                                </option>
                            </CFormSelect>
                            <span class="error" v-if="errors.booking_event">{{ errors.booking_event[0] }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlTextarea1">Choose Ticket</CFormLabel>
                            <CFormSelect
                                v-model="form.booking_ticket"
                                >
                                <option v-for="ticket in tickets" :key="ticket.value" :value="ticket.value">
                                    {{ ticket.label }}
                                </option>
                            </CFormSelect>
                            <span class="error" v-if="errors.booking_ticket">{{ errors.booking_ticket[0] }}</span>
                        </div> 

                        <div class="mb-3 d-grid gap-2">
                            <CButton color="primary" @click="handleSubmit">Add Booking</CButton>
                        </div>
                       
                    </CForm>
                </CCardBody>
            </CCard>    
        </CCol>
    </CRow>
</template>

<script>
import Event from '../apis/Events'
import Booking from '../apis/Booking'
export default {
    name : "AddBooking",
    data() {
        return {
            events : [{ label: '--Select Event--',value:'', tickets : []}],
            tickets: [{ label: '--Select Ticket--',value:'' }],
            form : {
                booking_person : '',
                booking_email  : '',
                booking_mobile : '',
                booking_event  : '',
                booking_ticket : ''
            },
            errors : []
        }
    },
    mounted() {
        Event.list_events().then((response) => {
            const data  = response.data.map((item) => {
                return {
                    label   : item.event_title,
                    value   : item.event_id,
                    tickets : item.tickets
                }
            })
            this.events = [...this.events, ...data]
        }).catch((error) => {
            if(error.response.status === 401){
                this.$store.commit('setLogout')
                localStorage.removeItem("token")
                this.$router.push({name:"login"})
            }
        })
    },
    methods : {
        getTickets(e){
            this.tickets = [{ label: '--Select Ticket--',value:'' }]
            if(e.target.value){
                const ch = this.events.find((val) => val.value == e.target.value)
                if(ch.tickets.length > 0){
                    const data = ch.tickets.map((item) => {
                        return {
                            label : item.ticket_label+"( "+item.ticket_price+" )",
                            value : item.ticket_id
                        }
                    })
                    this.tickets = [...this.tickets, ...data]
                }
            }
            //console.log(this.events);
        },
        handleSubmit(){
            console.log(this.form);
            Booking.create_booking(this.form).then((response) => {
                this.$router.push({name : "list-booking"})
            }).catch((error) => {
                if(error.response.status === 422){
                    this.errors = error.response.data.errors
                }
            })
        }
    }
}
</script>