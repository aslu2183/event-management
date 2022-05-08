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
                    <CTableBody v-if="booking_list.length > 0">
                      <CTableRow v-for="(booking,index) in booking_list" :key="booking.booking_id" style="cursor:pointer">
                        <CTableHeaderCell scope="row">{{ index + 1}}</CTableHeaderCell>
                        <CTableDataCell>{{ booking.booking_person }}</CTableDataCell>
                        <CTableDataCell>{{ booking.booking_mobile }}</CTableDataCell>
                        <CTableDataCell>{{ booking.get_events.event_title }}</CTableDataCell>
                        <CTableDataCell>{{ booking.get_tickets.ticket_label }}</CTableDataCell>
                       
                        <CTableDataCell style="text-align:center" >
                            <CButton color="danger" variant="outline" size="sm" class="m-1" @click="deleteBooking(booking)">
                                <CIcon icon="cil-trash" size="sm"></CIcon>
                            </CButton>
                             <CButton color="success" variant="outline" size="sm" class="m-1" @click="showBookingModal(booking)">
                                <CIcon icon="cil-folder-open" size="sm"></CIcon>
                            </CButton>
                        </CTableDataCell>
                      </CTableRow>
                    </CTableBody>

                    <CTableBody v-else>
                        <CTableRow>
                          <CTableDataCell colspan="5" style="text-align:center">No Records Found</CTableDataCell>
                        </CTableRow>
                    </CTableBody>
                  </CTable>
                </CCardBody>
              </CCard>
            </CCol>
          </CRow>

         <!-- For Viewing Tickets -->
        <CModal alignment="center" size="lg" scrollable :visible="showViewModal" @close="() => { showViewModal = false }" backdrop="static">
            <CModalHeader>
                <CModalTitle>Booking Details</CModalTitle>
            </CModalHeader>
            <CModalBody>
                <CRow>
                  <CCol :xs="12">
                    <CTable hover responsive bordered>
                        <CTableBody>
                          <CTableRow>
                            <CTableDataCell>Participant</CTableDataCell>
                            <CTableDataCell>{{ booking_data.booking_person }}</CTableDataCell>
                          </CTableRow>
                          <CTableRow>
                            <CTableDataCell>Email</CTableDataCell>
                            <CTableDataCell>{{ booking_data.booking_email }}</CTableDataCell>
                          </CTableRow>
                          <CTableRow>
                            <CTableDataCell>Mobile</CTableDataCell>
                            <CTableDataCell>{{ booking_data.booking_mobile }}</CTableDataCell>
                          </CTableRow>
                          <CTableRow>
                            <CTableDataCell>Event</CTableDataCell>
                            <CTableDataCell>{{ booking_data?.get_events?.event_title }}</CTableDataCell>
                          </CTableRow>
                          <CTableRow>
                            <CTableDataCell>Ticket Type</CTableDataCell>
                            <CTableDataCell>{{ booking_data?.get_tickets?.ticket_label }}</CTableDataCell>
                          </CTableRow>
                          <CTableRow>
                            <CTableDataCell>Ticket Price</CTableDataCell>
                            <CTableDataCell>{{ booking_data?.get_tickets?.ticket_price }}</CTableDataCell>
                          </CTableRow>
                        </CTableBody>    
                    </CTable>
                  </CCol>
                </CRow>    
            </CModalBody>
            <CModalFooter>
                <CButton color="secondary" @click="() => { showViewModal = false }">
                    Close
                </CButton>
            </CModalFooter>
        </CModal>
</template>

<script>
import Booking from '../apis/Booking'
export default {
  data(){
    return {
      booking_list : [],
      showViewModal: false,
      booking_data : {}
    }
  },
  methods : {
    showBookingModal(booking){
      this.showViewModal = true
      Booking.show_booking(booking.booking_id).then((response) => {
        this.booking_data = response.data
      }).catch((error) => {
        if(error.response.status === 401){
          this.$store.commit('setLogout')
          localStorage.removeItem("token")
          this.$router.push({name:"login"})
        }
      })
    },
    deleteBooking(booking){
      Booking.remove_booking(booking.booking_id).then((response) => {
        this.booking_list = this.booking_list.filter((item) => {
          return item.booking_id != booking.booking_id
        })
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
    Booking.list_booking().then((response) => {
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