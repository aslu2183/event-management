<template>
  
          <CRow>
            <CCol :xs="6" :lg="3" :sm="6" >
              <CWidgetStatsC class="mb-3" value="87.500" :progress="{ color: 'info', value: 75 }" title="Visitors">
                <template #icon><CIcon icon="cil-people" height="36"/></template>
                <template #title>Visitors</template>
              </CWidgetStatsC>
            </CCol>
            <CCol :xs="6" :lg="3" :sm="6" >
              <CWidgetStatsC class="mb-3" value="385" :progress="{ color: 'success', value: 75 }" title="New clients">
                <template #icon><CIcon icon="cil-user-follow" height="36"/></template>
              </CWidgetStatsC>
            </CCol>
            <CCol :xs="6" :lg="3" :sm="6" >
              <CWidgetStatsC class="mb-3" value="1238" :progress="{ color: 'info', value: 75 }" title="Product sold">
                <template #icon><CIcon icon="cil-basket" height="36"/></template>
              </CWidgetStatsC>
            </CCol>
            <CCol :xs="6" :lg="3" :sm="6" >
              <CWidgetStatsC class="mb-3" value="1238" :progress="{ color: 'info', value: 75 }" title="Product sold">
                <template #icon><CIcon icon="cil-basket" height="36"/></template>
              </CWidgetStatsC>
            </CCol>
          </CRow> 

          <CRow class="mt-4">
            <CCol :xs="12">
              <CCard class="mb-4">
                <CCardHeader>
                  <strong>New Events</strong>
                </CCardHeader>
                <CCardBody>
                  <CTable responsive>
                    <CTableHead>
                      <CTableRow>
                        <CTableHeaderCell scope="col">#</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Date</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Name</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Start Date</CTableHeaderCell>
                        <CTableHeaderCell scope="col">End Date</CTableHeaderCell>
                      </CTableRow>
                    </CTableHead>
                    <CTableBody v-if="events.length > 0">
                        <CTableRow v-for="(event,index) in events" :key="event.event_id">
                          <CTableHeaderCell scope="row">{{ index + 1 }}</CTableHeaderCell>
                          <CTableDataCell>{{ event.created_at }}</CTableDataCell>
                          <CTableDataCell>{{ event.event_title }}</CTableDataCell>
                          <CTableDataCell>{{ event.event_start }}</CTableDataCell>
                          <CTableDataCell>{{ event.event_end }}</CTableDataCell>
                        </CTableRow>
                    </CTableBody>

                    <CTableBody v-else>
                        <CTableRow>
                          <CTableDataCell colspan="4" style="text-align:center">No Records Found</CTableDataCell>
                        </CTableRow>
                    </CTableBody>

                  </CTable>
                </CCardBody>
              </CCard>
            </CCol>
          </CRow>

          <CRow class="mt-4">
            <CCol :xs="12">
              <CCard class="mb-4">
                <CCardHeader>
                  <strong>New Bookings</strong>
                </CCardHeader>
                <CCardBody>
                  <CTable responsive>
                    <CTableHead>
                      <CTableRow>
                        <CTableHeaderCell scope="col">#</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Date</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Name</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Mobile</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Event</CTableHeaderCell>
                      </CTableRow>
                    </CTableHead>
                    <CTableBody v-if="bookings.length > 0">
                        <CTableRow v-for="(booking,index) in bookings" :key="booking.booking_id">
                          <CTableHeaderCell scope="row">{{ index + 1 }}</CTableHeaderCell>
                          <CTableDataCell>{{ booking.created_at }}</CTableDataCell>
                          <CTableDataCell>{{ booking.booking_person }}</CTableDataCell>
                          <CTableDataCell>{{ booking.booking_phone }}</CTableDataCell>
                          <CTableDataCell>{{ booking?.get_events?.event_title }}</CTableDataCell>
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

       
</template>

<script>

import DashBoard from '../apis/Dashboard'
export default {
    name : "DashBoard",
    data(){
      return {
        events  : [],
        bookings: []
      }
    },
    mounted() {
      DashBoard.list_dashboard().then((response) => {
        this.events   = response.data.events;
        this.bookings = response.data.bookings;
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