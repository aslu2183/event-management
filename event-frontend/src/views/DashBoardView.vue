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
                  <CTable>
                    <CTableHead>
                      <CTableRow>
                        <CTableHeaderCell scope="col">#</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Class</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Heading</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Heading</CTableHeaderCell>
                      </CTableRow>
                    </CTableHead>
                    <CTableBody>
                      <CTableRow>
                        <CTableHeaderCell scope="row">1</CTableHeaderCell>
                        <CTableDataCell>Mark</CTableDataCell>
                        <CTableDataCell>Otto</CTableDataCell>
                        <CTableDataCell>@mdo</CTableDataCell>
                      </CTableRow>
                      <CTableRow>
                        <CTableHeaderCell scope="row">2</CTableHeaderCell>
                        <CTableDataCell>Jacob</CTableDataCell>
                        <CTableDataCell>Thornton</CTableDataCell>
                        <CTableDataCell>@fat</CTableDataCell>
                      </CTableRow>
                      <CTableRow>
                        <CTableHeaderCell scope="row">3</CTableHeaderCell>
                        <CTableDataCell colspan="2">Larry the Bird</CTableDataCell>
                        <CTableDataCell>@twitter</CTableDataCell>
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
                  <CTable>
                    <CTableHead>
                      <CTableRow>
                        <CTableHeaderCell scope="col">#</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Class</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Heading</CTableHeaderCell>
                        <CTableHeaderCell scope="col">Heading</CTableHeaderCell>
                      </CTableRow>
                    </CTableHead>
                    <CTableBody>
                      <CTableRow>
                        <CTableHeaderCell scope="row">1</CTableHeaderCell>
                        <CTableDataCell>Mark</CTableDataCell>
                        <CTableDataCell>Otto</CTableDataCell>
                        <CTableDataCell>@mdo</CTableDataCell>
                      </CTableRow>
                      <CTableRow>
                        <CTableHeaderCell scope="row">2</CTableHeaderCell>
                        <CTableDataCell>Jacob</CTableDataCell>
                        <CTableDataCell>Thornton</CTableDataCell>
                        <CTableDataCell>@fat</CTableDataCell>
                      </CTableRow>
                      <CTableRow>
                        <CTableHeaderCell scope="row">3</CTableHeaderCell>
                        <CTableDataCell colspan="2">Larry the Bird</CTableDataCell>
                        <CTableDataCell>@twitter</CTableDataCell>
                      </CTableRow>
                    </CTableBody>
                  </CTable>
                </CCardBody>
              </CCard>
            </CCol>
          </CRow>

       
</template>

<script>


export default {
    name : "DashBoard",
    
}
</script>

<style>

</style>