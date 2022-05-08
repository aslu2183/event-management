<template>
  
          <CRow>
            <CCol :xs="6" :lg="3" :sm="6" >
              <CWidgetStatsC class="mb-3" :value="events_no" :progress="{ color: 'info', value: 75 }" title="Events">
                <template #icon><CIcon icon="cil-book" height="36"/></template>
                <template #title>Events</template>
              </CWidgetStatsC>
            </CCol>
            <CCol :xs="6" :lg="3" :sm="6" >
              <CWidgetStatsC class="mb-3" :value="tickets_no" :progress="{ color: 'success', value: 75 }" title="Tickets">
                <template #icon><CIcon icon="cil-book" height="36"/></template>
              </CWidgetStatsC>
            </CCol>
            <CCol :xs="6" :lg="3" :sm="6" >
              <CWidgetStatsC class="mb-3" :value="booking_no" :progress="{ color: 'info', value: 75 }" title="Bookings">
                <template #icon><CIcon icon="cil-book" height="36"/></template>
              </CWidgetStatsC>
            </CCol>
            <CCol :xs="6" :lg="3" :sm="6" >
              <CWidgetStatsC class="mb-3" :value="users_no" :progress="{ color: 'info', value: 75 }" title="Users">
                <template #icon><CIcon icon="cil-people" height="36"/></template>
              </CWidgetStatsC>
            </CCol>
          </CRow> 

          <!--Chart will render only when y-axis data available -->
          <CRow v-if="ydata.length > 0">
            <CCol :xs="12">
              <CChartBar
                style="height:300px"
                :options="{ maintainAspectRatio: false }"
                :data = defaultData
              />
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
                          <CTableDataCell>{{ moment().utc(event.created_at).format("DD-MM-YYYY") }}</CTableDataCell>
                          <CTableDataCell>{{ event.event_title }}</CTableDataCell>
                          <CTableDataCell>{{ moment().utc(event.event_start).format("DD-MM-YYYY") }}</CTableDataCell>
                          <CTableDataCell>{{ moment().utc(event.event_end).format("DD-MM-YYYY") }}</CTableDataCell>
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
                          <CTableDataCell>{{ moment().utc(booking.created_at).format("DD-MM-YYYY") }}</CTableDataCell>
                          <CTableDataCell>{{ booking.booking_person }}</CTableDataCell>
                          <CTableDataCell>{{ booking.booking_mobile }}</CTableDataCell>
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
import { CChartBar } from '@coreui/vue-chartjs'
import moment from 'moment'
export default {
    name : "DashBoard",
    data(){
      return {
        events  : [],
        bookings: [],
        labels  : [
          'January',
          'February',
          'March',
          'April',
          'May',
          'June',
          'July',
          'August',
          'September',
          'October',
          'November',
          'December',
        ],
        ydata     : [],
        users_no  : 0,
        events_no : 0,
        tickets_no: 0,
        booking_no: 0
      }
    },
    mounted() {
      DashBoard.list_dashboard().then((response) => {
        this.users_no   = response.data.user_cnt;
        this.events_no  = response.data.events_cnt;
        this.tickets_no = response.data.tickets_cnt;
        this.booking_no = response.data.booking_cnt
        this.events     = response.data.events;
        this.bookings   = response.data.bookings;
        this.ydata      = this.labels.map((item,i) => {
          const check   = i + 1
          const data    = response.data.chart_data.find((val) => val.month == check)
          if(data){
            return data.nos
          }
          else{
            return 0
          }
        })
        
      }).catch((error) => {
        if(error.response.status === 401){
          this.$store.commit('setLogout')
          localStorage.removeItem("token")
          this.$router.push({name:"login"})
        }
      })
    },
    components : {
      CChartBar
    },
    computed: {
      defaultData() {
        return {
          labels: this.labels,
          datasets: [
            {
              label: 'Bookings Per Month',
              backgroundColor: '#f87979',
              data: this.ydata,
            },
          ],
        }
      }
    },
    methods : {
      moment(){
        return moment
      }
    }
}
</script>

<style>

</style>