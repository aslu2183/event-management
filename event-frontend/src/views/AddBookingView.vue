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
                            <CFormInput type="text" id="exampleFormControlInput1" placeholder="name@example.com"/>
                        </div>
                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlTextarea1">Email Id</CFormLabel>
                            <CFormInput type="email" id="exampleFormControlInput1" placeholder="name@example.com"/>
                        </div>
                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlTextarea1">Mobile Number</CFormLabel>
                            <CFormInput type="text" id="exampleFormControlInput1" placeholder="name@example.com"/>
                        </div>
                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlTextarea1">Choose an Event</CFormLabel>
                            <CFormSelect
                                :options="[
                                    {label: '--Select Event--',value:''},
                                    { label: 'One', value: '1' },
                                    { label: 'Two', value: '2' },
                                    { label: 'Three', value: '3', disabled: true }
                                ]">
                            </CFormSelect>
                        </div>
                        
                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlTextarea1">Choose Ticket</CFormLabel>
                            <CFormSelect
                                :options="[
                                    {label: '--Select Ticket--',value:''},
                                    { label: 'One', value: '1' },
                                    { label: 'Two', value: '2' },
                                    { label: 'Three', value: '3', disabled: true }
                                ]">
                            </CFormSelect>
                        </div> 

                        <div class="mb-3 d-grid gap-2">
                            <CButton color="primary">Add Booking</CButton>
                        </div>
                       
                    </CForm>
                </CCardBody>
            </CCard>    
        </CCol>
    </CRow>
</template>

<script>
export default {
    name : "AddBooking"
}
</script>