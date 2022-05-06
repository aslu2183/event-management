<template>
    <CRow class="justify-content-center">
        <CCol :xs="12" :lg="6" :md="12" :sm="12" >
            <CCard class="mb-4">
                <CCardHeader>
                  <strong>Add New Event</strong>
                </CCardHeader>
                <CCardBody>
                    <CForm>
                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlInput1">Event Title</CFormLabel>
                            <CFormInput type="text" id="exampleFormControlInput1" placeholder="name@example.com"/>
                        </div>
                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlTextarea1">Event Start Date</CFormLabel>
                            <CFormInput type="date" id="exampleFormControlInput1" placeholder="name@example.com"/>
                        </div>
                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlTextarea1">Event End Date</CFormLabel>
                            <CFormInput type="date" id="exampleFormControlInput1" placeholder="name@example.com"/>
                        </div>
                        <div class="mb-3">
                            <CCardHeader class="mb-2">
                                <CRow>
                                    <CCol :xs="8" :md="9" :lg="10"><strong>Event Line Ups</strong></CCol>
                                    <CCol :xs="4" :md="3" :lg="2" style="text-align:right">
                                        <CRow>
                                            <CCol @click="removelineups" style="cursor:pointer" v-if="numbers">
                                                <CIcon icon="cil-minus" size="xl"></CIcon>
                                            </CCol>
                                            
                                            <CCol @click="addlineups" style="cursor:pointer">
                                                <CIcon icon="cil-plus" size="xl"></CIcon>
                                            </CCol>

                                            
                                        </CRow>
                                    </CCol>
                                </CRow>
                            </CCardHeader>

                            <div v-for="number in numbers" :key="number">
                                <CRow>
                                    <CCol :xs="12" :md="12" :lg="6" class="mb-2">
                                        <CFormLabel for="lineup_title">Title</CFormLabel>
                                        <CFormInput placeholder="Title" id="lineup_title"/>
                                    </CCol>
                                    <CCol :xs="12" :md="12" :lg="3" class="mb-2">
                                        <CFormLabel for="start_time">Start at</CFormLabel>
                                        <CFormInput id="start_time" type="time"/>
                                    </CCol>
                                    <CCol :xs="12" :md="12" :lg="3" class="mb-2">
                                        <CFormLabel for="end_time">End at</CFormLabel>
                                        <CFormInput id="end_time" type="time"/>
                                    </CCol>
                                </CRow>
                                <CHeaderDivider />
                            </div>
                        </div>

                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlTextarea1">Event Description</CFormLabel>
                            <CFormTextarea id="exampleFormControlTextarea1" rows="3"></CFormTextarea>
                        </div> 

                        <div class="mb-3 d-grid gap-2">
                            <CButton color="primary">Button</CButton>
                        </div>
                       
                    </CForm>
                </CCardBody>
            </CCard>    
        </CCol>
    </CRow>
</template>



<script>
export default {
    data(){
        return {
            numbers : 0
        }
    },
    methods : {
        addlineups(){
            this.numbers = this.numbers + 1
        },
        removelineups(){
            this.numbers = this.numbers - 1
        }
    }
}
</script>

<style>

</style>