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
                            <CFormInput type="text" ref="check" id="exampleFormControlInput1" placeholder="Event Title" v-model="form.event_title"/>
                            <span class="error" v-if="errors.event_title">{{ errors.event_title[0] }}</span>
                        </div>
                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlTextarea1">Event Start Date</CFormLabel>
                            <CFormInput type="date" id="exampleFormControlInput1" v-model="form.event_start"/>
                            <span class="error" v-if="errors.event_start">{{ errors.event_start[0] }}</span>
                        </div>
                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlTextarea1">Event End Date</CFormLabel>
                            <CFormInput type="date" id="exampleFormControlInput1" v-model="form.event_end"/>
                            <span class="error" v-if="errors.event_end">{{ errors.event_end[0] }}</span>
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

                            <div v-for="(lineup,index) in form.line_ups" :key="index">
                                <CRow>
                                    <CCol :xs="12" :md="12" :lg="6" class="mb-2">
                                        <CFormLabel for="lineup_title">Title</CFormLabel>
                                        <CFormInput placeholder="Title" id="lineup_title" v-model="lineup.event_line_up_title" type="text" />
                                    </CCol>
                                    <CCol :xs="12" :md="12" :lg="3" class="mb-2">
                                        <CFormLabel for="start_time">Start at</CFormLabel>
                                        <CFormInput id="start_time" type="time" v-model="lineup.event_line_up_start"/>
                                    </CCol>
                                    <CCol :xs="12" :md="12" :lg="3" class="mb-2">
                                        <CFormLabel for="end_time">End at</CFormLabel>
                                        <CFormInput id="end_time" type="time" v-model="lineup.event_line_up_end"/>
                                    </CCol>
                                </CRow>
                                <CHeaderDivider />
                            </div>
                            <span class="error" v-if="errors.line_ups">{{ errors.line_ups[0] }}</span>
                        </div>

                        <div class="mb-3">
                            <CFormLabel for="exampleFormControlTextarea1">Event Description</CFormLabel>
                            <CFormTextarea id="exampleFormControlTextarea1" rows="3" v-model="form.event_description"></CFormTextarea>
                        </div> 

                        <div class="mb-3 d-grid gap-2">
                            <CButton color="primary" @click="handleSubmit">Add Event</CButton>
                        </div>
                       
                    </CForm>
                </CCardBody>
            </CCard>    
        </CCol>
    </CRow>
</template>



<script>
import Event from '../apis/Events';
export default {
    data(){
        return {
            numbers : 0,
            form : {
                event_title       : '',
                event_start       : '',
                event_end         : '',
                event_description : '',
                line_ups          : []
            },
            errors : []
        }
    },
    methods : {
        addlineups(){
            this.form.line_ups.push({
                event_line_up_title : '',
                event_line_up_start : '',
                event_line_up_end   : ''
            })
        },
        removelineups(){
            this.form.line_ups.pop();
        },
        handleSubmit(){
            Event.add_event(this.form).then((response) => {
                this.errors = [];
                this.$router.push({name:"list-events"})
            }).catch((error) => {
                if(error.response.status === 422){
                    this.errors = error.response.data.errors
                }
            })
        }

    }
}
</script>

<style scoped>
.error {
  color:red
}
</style>