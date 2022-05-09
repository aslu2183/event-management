<template>
<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
  <CContainer>
      <CRow class="justify-content-center">
        <CCol :md="10" :xs="12" :lg="8" :xl="5">
          <CCardGroup>
            <CCard class="p-4">
              <CCardBody>
                <CForm>
                  <h1>Login</h1>
                  <p class="text-medium-emphasis">Sign In to your account</p>
                  <div class="mb-3">
                  <CInputGroup >
                    <CInputGroupText>
                      <CIcon icon="cil-user" />
                    </CInputGroupText>
                    <CFormInput
                      placeholder="Username"
                      autocomplete="username"
                      v-model="form.email"
                      @keyup.enter="handleSubmit"
                    />
                    
                  </CInputGroup>
                  <span class="error" v-if="errors.email">{{ errors.email[0] }}</span>
                  </div>
                  <div class="mb-4">
                  <CInputGroup >
                    <CInputGroupText>
                      <CIcon icon="cil-lock-locked" />
                    </CInputGroupText>
                    <CFormInput
                      type="password"
                      placeholder="Password"
                      autocomplete="current-password"
                      v-model="form.password"
                      @keyup.enter="handleSubmit"
                    />
                    
                  </CInputGroup>
                  <span class="error" v-if="errors.password">{{ errors.password[0] }}</span>
                  </div>
                  <CRow>
                    <CCol :xs="6">
                      <CButton color="primary" class="px-4" @click="handleSubmit" :disabled="isloading"> 
                        <CSpinner component="span" size="sm" aria-hidden="true" v-if="isloading"/>
                        Login 
                      </CButton>
                    </CCol>
                    
                  </CRow>
                </CForm>
              </CCardBody>
            </CCard>
            
          </CCardGroup>
        </CCol>
      </CRow>
    </CContainer>
</div>
</template>

<script>

import User from '../apis/Users';

export default {
  name: 'LoginView',
  data() {
    return {
      form : {
        email    : '',
        password : ''
      },
      errors : [],
      isloading : false
    }
  },
  methods : {
    handleSubmit() {
      this.isloading = true
      User.signIn(this.form).then((response) => {
        localStorage.setItem("token",response.data);
        this.isloading = false
        this.$store.commit('setLogin');
        this.$router.push({name:"dashboard"})
      }).catch((error) => {
        this.isloading = false
        if(error.response.status === 422){
          this.errors = error.response.data.errors
        }
      });
      
    }
  }
  
}
</script>

<style scoped>
.error {
  color:red
}
</style>
