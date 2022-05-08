<template>
    <CHeader position="sticky" class="mb-4">
            <CContainer fluid>
                <CHeaderToggler class="ps-1" @click="toggle_sidebar">
                    <CIcon icon="cil-menu" size="lg" />
                </CHeaderToggler>
                <CHeaderBrand class="mx-auto d-lg-none" to="/">
                    <!-- <CIcon :icon="logo" height="48" alt="Logo" /> -->
                    <CCardImage height="48" alt="Logo" :src="logo"></CCardImage>
                </CHeaderBrand>

                <CHeaderNav class="d-none d-md-flex me-auto">
                    
                </CHeaderNav>

                <CHeaderNav>
                    <CNavItem>
                        <CNavLink href="#">
                            Logged as : {{ myProfile.name }}
                        </CNavLink>
                    </CNavItem>
                    <CDropdown variant="nav-item">
                        <CDropdownToggle placement="bottom-end" class="py-0" :caret="false">
                            <CAvatar :src="avatar" size="md" />
                            
                        </CDropdownToggle>
                        <CDropdownMenu class="pt-0">
                            <CDropdownHeader component="h6" class="bg-light fw-semibold py-2">
                                Account
                            </CDropdownHeader>
                            <CDropdownItem>
                                <CIcon icon="cil-envelope-open" /> Messages
                            </CDropdownItem>
                            <CDropdownItem @click="logout">
                                <CIcon icon="cil-lock-locked" /> Logout
                            </CDropdownItem>
                        </CDropdownMenu>    
                    </CDropdown>  
                </CHeaderNav>
            </CContainer>
    </CHeader>   
    
</template>

<script>
// import { logo } from '@/assets/brand/logo'
import logo from '@/assets/images/logo.png'
import avatar from '@/assets/images/avatars/8.jpg'
import User from '../apis/Users'
export default {
    data() {
        return {
            visible : true,
            logo,
            avatar
        }
    },
    methods : {
        toggle_sidebar(){
            this.$store.commit('toggleSidebar')
        },
        logout(){
            User.signOut().then((response) => {
                this.$store.commit('setLogout')
                localStorage.removeItem("token")
                this.$router.push({name:"login"})
            }).catch((error) => {
                
                this.$store.commit('setLogout')
                localStorage.removeItem("token")
                this.$router.push({name:"login"})
                
            })
        }
    },
    computed : {
        myProfile(){
            return this.$store.state.user 
        }
    },
    name : "Header",
    
}
</script>

<style>

</style>