<template>
     <CRow class="mt-4">
            <CCol :xs="12">
              <CCard class="mb-4">
                <CCardHeader>
                  <strong>Event Listing</strong>
                </CCardHeader>
                <CCardBody>
                  <CTable hover responsive>
                    <CTableHead>
                      <CTableRow>
                        <CTableHeaderCell scope="col">#</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Title</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Start Date</CTableHeaderCell>
                        <CTableHeaderCell scope="col">End Date</CTableHeaderCell>
                        <CTableHeaderCell scope="col" style="text-align:center">Tickets</CTableHeaderCell>
                        <CTableHeaderCell scope="col" style="text-align:center">Action</CTableHeaderCell>
                      </CTableRow>
                    </CTableHead>

                    <CTableBody v-if="event_list.length > 0">
                      <CTableRow v-for="(event,index) in event_list" :key="event.event_id" style="cursor:pointer">
                        <CTableHeaderCell scope="row">{{ index + 1}}</CTableHeaderCell>
                        <CTableDataCell>{{ event.event_title }}</CTableDataCell>
                        <CTableDataCell>{{ event.event_start }}</CTableDataCell>
                        <CTableDataCell>{{ event.event_end }}</CTableDataCell>
                        <CTableDataCell style="text-align:center" >
                            <CButton color="primary" variant="outline" size="sm" class="m-1" @click="openModal(event.event_id)">
                                <CIcon icon="cil-plus" size="sm"></CIcon>
                            </CButton>
                            <CButton color="success" variant="outline" size="sm" class="m-1" @click="openViewModal(event.event_id)">
                                <CIcon icon="cil-folder-open" size="sm"></CIcon>
                            </CButton>
                        </CTableDataCell >
                        <CTableDataCell style="text-align:center" >
                            <CButton color="danger" variant="outline" size="sm" class="m-1" @click="deleteEvent(event)">
                                <CIcon icon="cil-trash" size="sm"></CIcon>
                            </CButton>
                             <CButton color="success" variant="outline" size="sm" class="m-1">
                                <CIcon icon="cil-folder-open" size="sm"></CIcon>
                            </CButton>
                        </CTableDataCell>
                      </CTableRow>
                    </CTableBody>

                    <CTableBody v-else>
                        <CTableRow>
                            <CTableDataCell colspan="6" style="text-align:center">No Records Found</CTableDataCell>
                        </CTableRow>
                    </CTableBody>
                  </CTable>
                </CCardBody>
              </CCard>
            </CCol>
          </CRow>

        <!-- For Creating Tickets -->
        <CModal alignment="center" :visible="showModal" @close="() => { showModal = false }" backdrop="static">
            <CModalHeader>
                <CModalTitle>Create Ticket</CModalTitle>
            </CModalHeader>
            <CModalBody>
                <CForm>
                    <div class="mb-3">
                        <CFormLabel for="exampleFormControlInput1">Label</CFormLabel>
                        <CFormInput type="text" id="exampleFormControlInput1" placeholder="Ticket Label" v-model="form.ticket_label"/>
                        <span class="error" v-if="errors.ticket_label">{{ errors.ticket_label[0] }}</span>
                    </div>
                    <div class="mb-3">
                        <CFormLabel for="exampleFormControlInput1">Capacity</CFormLabel>
                        <CFormInput type="number" id="exampleFormControlInput1" placeholder="Ticket Capacity" v-model="form.ticket_capacity"/>
                        <span class="error" v-if="errors.ticket_capacity">{{ errors.ticket_capacity[0] }}</span>
                    </div>
                    <div class="mb-3">
                        <CFormLabel for="exampleFormControlInput1">Price</CFormLabel>
                        <CFormInput type="number" id="exampleFormControlInput1" placeholder="Ticket Price" v-model="form.ticket_price"/>
                        <span class="error" v-if="errors.ticket_price">{{ errors.ticket_price[0] }}</span>
                    </div>
                </CForm>
            </CModalBody>
            <CModalFooter>
                <CButton color="secondary" @click="() => { showModal = false }">
                    Close
                </CButton>
                <CButton color="primary" @click="handleSave">Save</CButton>
            </CModalFooter>
        </CModal>

         <!-- For Viewing Tickets -->
        <CModal alignment="center" size="lg" scrollable :visible="showViewModal" @close="() => { showViewModal = false }" backdrop="static">
            <CModalHeader>
                <CModalTitle>List Event Tickets</CModalTitle>
            </CModalHeader>
            <CModalBody>
                <CRow>
                    <CCol :xs="12" :md="12" :lg="4" v-for="ticket in event_tickets" :key="ticket.ticket_id">
                        <CWidgetStatsB
                            class="mb-3"
                            :progress="{ color: 'success', value: 75}"
                            >
                            <template #text>Capacity {{ ticket.ticket_capacity }}</template>
                            <template #title>{{ ticket.ticket_label }}</template>
                            <template #value>{{ ticket.ticket_price }}</template>
                            
                        </CWidgetStatsB>
                        <div class="del-ticket m-1" @click="deleteTicket(ticket)">
                            <CIcon icon="cil-trash" size="xl" ></CIcon>
                        </div>    
                    </CCol>
                </CRow>    
            </CModalBody>
            <CModalFooter>
                <span class="error" v-if="errors.delete_error" style="flex:1;justify-content:flex-start">{{ errors.delete_error}}</span>
                <CButton color="secondary" @click="() => { showViewModal = false }">
                    Close
                </CButton>
            </CModalFooter>
        </CModal>
</template>

<script>
import Event from '../apis/Events'
export default {
    data(){
        return {
            event_list:[],
            showModal : false,
            showViewModal : false,
            form : {
                ticket_label    : '',
                ticket_capacity : '',
                ticket_price    : '',
                event_id        : 0
            },
            errors : [],
            event_tickets : []
        }
    },
    methods : {
        openModal(event){
            this.showModal = true
            this.form.event_id = event
            this.form.ticket_label = ''
            this.form.ticket_capacity = ''
            this.form.ticket_price = ''
            this.errors = []
        },
        openViewModal(event){
            this.showViewModal = true
            this.errors = []
            Event.get_event_tickets(event).then((response) => {
                this.event_tickets = response.data.tickets
            }).catch((error) => {
                if(error.response.status === 401){
                    this.$store.commit('setLogout')
                    localStorage.removeItem("token")
                    this.$router.push({name:"login"})
                }
            })
        },
        handleSave(){
            Event.create_tickets(this.form).then((response) => {
                this.errors = []
                this.showModal = false
            }).catch((error) => {
                if(error.response.status === 422){
                    this.errors = error.response.data.errors
                }
            })
        },
        deleteTicket(ticket){
            this.errors = []
            Event.remove_tickets(ticket.ticket_id).then((response) => {
                if(response.data != 0){
                    this.event_tickets = this.event_tickets.filter((item) => {
                        return item.ticket_id != ticket.ticket_id
                    })
                }
                else{
                    const data = {
                        delete_error : "A Booking already done on this ticket. Cannot Delete Ticket."
                    }
                    this.errors = { ...this.errors, ...data}
                    
                }    
            }).catch((error) => {
                if(error.response.status === 401){
                    this.$store.commit('setLogout')
                    localStorage.removeItem("token")
                    this.$router.push({name:"login"})
                }
            })
        },
        deleteEvent(event){
            Event.remove_event(event.event_id).then((response) => {
                if(response.data != 0){
                    this.event_list = this.event_list.filter((item) => {
                        return item.event_id != event.event_id
                    })
                }
                else{
                    console.log("cannot delete");
                }
            }).catch((error) => {
                if(error.response.status === 401){
                    this.$store.commit('setLogout')
                    localStorage.removeItem("token")
                    this.$router.push({name:"login"})
                }
            })
        }
    },
    mounted(){
        Event.list_events().then((response) => {
            this.event_list = response.data
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

