<template>
    <CHeader position="sticky" class="mb-4">
            <CContainer fluid>
                <CHeaderToggler class="ps-1" @click="toggle_sidebar">
                    <CIcon icon="cil-menu" size="lg" />
                </CHeaderToggler>
                <CHeaderBrand class="mx-auto d-lg-none" to="/">
                    <CIcon :icon="logo" height="48" alt="Logo" />
                </CHeaderBrand>

                <CHeaderNav class="d-none d-md-flex me-auto">
                    <CNavItem>
                        <CNavLink href="/dashboard"> Dashboard </CNavLink>
                    </CNavItem>

                    <CNavItem>
                        <CNavLink href="#">Users</CNavLink>
                    </CNavItem>

                    <CNavItem>
                        <CNavLink href="#">Settings</CNavLink>
                    </CNavItem>

                </CHeaderNav>

                <CHeaderNav>
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
                            <CDropdownItem>
                                <CIcon icon="cil-lock-locked" /> Logout
                            </CDropdownItem>
                        </CDropdownMenu>    
                    </CDropdown>  
                </CHeaderNav>
            </CContainer>
    </CHeader>   
    
</template>

<script>
import { CHeader, CContainer, CHeaderBrand, CHeaderToggler, CCollapse, CHeaderNav, CNavItem, CNavLink, CDropdown,CDropdownItem, CDropdownToggle, CAvatar, CDropdownMenu, CDropdownHeader} from '@coreui/vue'
import { logo } from '@/assets/brand/logo'
import avatar from '@/assets/images/avatars/8.jpg'
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
            console.log(this.$store.state.sidebarVisible)
            this.$store.commit('toggleSidebar')
        }
    },
    name : "Header",
    components : {
        CHeader,
        CContainer,
        CHeaderBrand,
        CHeaderToggler,
        CCollapse,
        CHeaderNav,
        CNavItem,
        CNavLink,
        CDropdown,
        CDropdownItem,
        CDropdownToggle,
        CAvatar,
        CDropdownMenu,
        CDropdownHeader
    }
}
</script>

<style>

</style>