<template>
  <CRow class="mt-4">
            <CCol :xs="12">
              <CCard class="mb-4">
                <CCardHeader>
                  <strong>Event Registration Listing</strong>
                </CCardHeader>
                <CCardBody>
                  <CTable hover>
                    <CTableHead>
                      <CTableRow>
                        <CTableHeaderCell scope="col">#</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Name</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Mobile</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Event</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Ticket</CTableHeaderCell>
                        <CTableHeaderCell scope="col" style="text-align:center">Action</CTableHeaderCell>
                      </CTableRow>
                    </CTableHead>
                    <CTableBody>
                      <CTableRow v-for="(booking,index) in booking_list" :key="booking.booking_id" style="cursor:pointer">
                        <CTableHeaderCell scope="row">{{ index + 1}}</CTableHeaderCell>
                        <CTableDataCell>{{ booking.booking_person }}</CTableDataCell>
                        <CTableDataCell>{{ booking.booking_mobile }}</CTableDataCell>
                        <CTableDataCell>{{ booking.get_events.event_title }}</CTableDataCell>
                        <CTableDataCell>{{ booking.get_tickets.ticket_label }}</CTableDataCell>
                        <!-- <CTableDataCell style="text-align:center" >
                            <CButton color="primary" variant="outline" size="sm" class="m-1" @click="openModal(event.event_id)">
                                <CIcon icon="cil-plus" size="sm"></CIcon>
                            </CButton>
                            <CButton color="success" variant="outline" size="sm" class="m-1" @click="openViewModal(event.event_id)">
                                <CIcon icon="cil-folder-open" size="sm"></CIcon>
                            </CButton>
                        </CTableDataCell > -->
                        <CTableDataCell style="text-align:center" >
                            <CButton color="danger" variant="outline" size="sm" class="m-1">
                                <CIcon icon="cil-trash" size="sm"></CIcon>
                            </CButton>
                             <CButton color="success" variant="outline" size="sm" class="m-1">
                                <CIcon icon="cil-folder-open" size="sm"></CIcon>
                            </CButton>
                        </CTableDataCell>
                      </CTableRow>
                    </CTableBody>
                  </CTable>
                </CCardBody>
              </CCard>
            </CCol>
          </CRow>

        <!-- For Creating Tickets -->
        <!-- <CModal alignment="center" :visible="showModal" @close="() => { showModal = false }" backdrop="static">
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
        </CModal> -->

         <!-- For Viewing Tickets -->
        <!-- <CModal alignment="center" size="lg" :visible="showViewModal" @close="() => { showViewModal = false }" backdrop="static">
            <CModalHeader>
                <CModalTitle>List Event Tickets</CModalTitle>
            </CModalHeader>
            <CModalBody>
                <CRow>
                    <CCol :xs="4" v-for="ticket in event_tickets" :key="ticket.ticket_id">
                        <CWidgetStatsB
                            class="mb-3"
                            :progress="{ color: 'success', value: 75}"
                            >
                            <template #text>Capacity {{ ticket.ticket_capacity }}</template>
                            <template #title>{{ ticket.ticket_label }}</template>
                            <template #value>{{ ticket.ticket_price }}</template>
                        </CWidgetStatsB>
                    </CCol>
                </CRow>    
            </CModalBody>
            <CModalFooter>
                <CButton color="secondary" @click="() => { showViewModal = false }">
                    Close
                </CButton>
            </CModalFooter>
        </CModal> -->
</template>

<script>
import Booking from '../apis/Booking'
export default {
  data(){
    return {
      booking_list : []
    }
  },
  mounted(){
    Booking.list_booking().then((response) => {
      console.log(response.data);
      this.booking_list = response.data
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