<template>
    <CRow>
        <CCol :xs="12">
            <CCard class="mb-4">
                <CCardHeader>
                    <strong>Report Based On Events</strong>
                </CCardHeader>
                <CCardBody>  
                    <!-- Filter Area -->  
                    <CRow class="mt-4">
                        <CCol :xs="12" :md="12" :lg="3" class="mb-2">
                            <CFormLabel for="for_event">Choose Event</CFormLabel>
                            <CFormSelect id="for_event" v-model="form.event">
                                <option value=''>--Select Event--</option>
                                <option v-for="event in events" :key="event.value" :value="event.value">
                                    {{ event.label }}
                                </option>
                            </CFormSelect>
                            <span class="error" v-if="errors.event">{{ errors.event[0]}}</span>
                        </CCol>
                        <CCol :xs="12" :md="12" :lg="3" class="mb-2">
                            <CFormLabel for="event_booking">From Date</CFormLabel>
                            <CFormInput type="date" id="exampleFormControlInput1" v-model="form.from_date"/>
                            <span class="error" v-if="errors.from_date">{{ errors.from_date[0]}}</span>
                        </CCol>

                        <CCol :xs="12" :md="12" :lg="3" class="mb-2">
                            <CFormLabel for="event_booking">To Date</CFormLabel>
                            <CFormInput type="date" id="exampleFormControlInput1" v-model="form.to_date"/>
                        </CCol>

                        <CCol :xs="12" :md="12" :lg="3" class="mb-2 mt-4">
                            <CButton color="primary" @click="getReport">Get Report</CButton>
                        </CCol>
                    </CRow>

                    <!--Filter Area Ends Here -->

                    <CRow class="mt-5">
                        <CCol :xs="12">
                            <CTable hover responsive>
                                <CTableHead>
                                    <CTableRow>
                                        <CTableHeaderCell scope="col">#</CTableHeaderCell>
                                        <CTableHeaderCell scope="col">Booked On</CTableHeaderCell>
                                        <CTableHeaderCell scope="col">Participant</CTableHeaderCell>
                                        <CTableHeaderCell scope="col">Mobile</CTableHeaderCell>
                                        <CTableHeaderCell scope="col">Ticket</CTableHeaderCell>
                                        <CTableHeaderCell scope="col">Price</CTableHeaderCell>
                                    </CTableRow>
                                </CTableHead>    

                                <CTableBody v-if="results.length > 0">
                                    <CTableRow v-for="(result,index) in results" :key="result.booking_id">
                                        <CTableHeaderCell scope="row">{{ index + 1}}</CTableHeaderCell>
                                        <CTableDataCell>{{ moment().utc(result.created_at).format('DD-MM-YYYY') }}</CTableDataCell>  
                                        <CTableDataCell>{{ result.booking_person }}</CTableDataCell> 
                                        <CTableDataCell>{{ result.booking_mobile }}</CTableDataCell>
                                        <CTableDataCell>{{ result.get_tickets.ticket_label }}</CTableDataCell> 
                                        <CTableDataCell>{{ result.get_tickets.ticket_price }}</CTableDataCell>     
                                    </CTableRow>
                                </CTableBody>

                                <CTableBody v-else>
                                    <CTableRow>
                                        <CTableDataCell colspan="6" style="text-align:center">No Record Found</CTableDataCell>     
                                    </CTableRow>
                                </CTableBody>
                                
                            </CTable>    
                        </CCol>
                    </CRow>
                </CCardBody>
            </CCard>
        </CCol>            
    </CRow>    
</template>

<script>
import Event from '../apis/Events'
import moment from 'moment';
export default {
    data(){
        return {
            events : [],
            form : {
                event     : '',
                from_date : '',
                to_date   : ''
            },
            errors : [],
            results: []
        }
    },
    methods : {
        getReport(){
            Event.get_report_based_on_events(this.form).then((response) => {
                this.errors  = []
                this.results = response.data
            }).catch((error) => {
                if(error.response.status === 422){
                    this.errors = error.response.data.errors
                }
                else if(error.response.status === 419){
                    this.$store.commit('setLogout')
                    localStorage.removeItem("token")
                    this.$router.push({name:"login"})
                }
            })
        },
        moment(){
            return moment
        }
    },
    mounted(){
        Event.list_events().then((response) => {
            this.events = response.data.map((item) => {
                return {
                    label : item.event_title,
                    value : item.event_id
                }
            })
        }).catch((error) => {
            if(error.response.status === 401){
                this.$store.commit('setLogout')
                localStorage.removeItem("token")
                this.$router.push({name:"login"})
            }
        })
    }
}
</script>

<style>

</style>