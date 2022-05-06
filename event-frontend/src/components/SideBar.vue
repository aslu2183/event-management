<template>
    
    <CSidebar 
        position="fixed"
        :visible="isVisible"
        @visible-change="change_visible"
    >
        <CSidebarBrand>Sidebar Brand </CSidebarBrand>
        <CSidebarNav>
            <li class="nav-title">Nav Title</li>
            <CNavItem href="#">
            <CIcon  customClassName="nav-icon" icon="cil-speedometer"/>
            Nav item
            </CNavItem>
            <CNavItem href="#">
                <CIcon  customClassName="nav-icon" icon="cil-speedometer"/>
                With badge
                <CBadge color="primary ms-auto">NEW</CBadge>
            </CNavItem>
            <CNavGroup>
            <template #togglerContent>
                <CIcon  customClassName="nav-icon" icon="cil-puzzle"/> Nav dropdown
            </template>
            <CNavItem href="#">
                <CIcon  customClassName="nav-icon" icon="cil-puzzle"/> Nav dropdown item
            </CNavItem>
            <CNavItem href="#">
                <CIcon  customClassName="nav-icon" icon="cil-puzzle"/> Nav dropdown item
            </CNavItem>
            </CNavGroup>
        </CSidebarNav>
        
    </CSidebar>
    
</template>

<script>
import { CSidebar, CSidebarBrand, CSidebarNav, CNavItem, CNavGroup } from '@coreui/vue'

export default {
    name : "SideBar",
    components : {
        CSidebar,
        CSidebarBrand,
        CSidebarNav,
        CNavItem,
        CNavGroup,
        
    },
    methods : {
        change_visible(e){
            this.$store.commit('updateSidebarVisible',{
                value : e
            })
        }
    },
    computed : {
        isVisible(){
            return this.$store.state.sidebarVisible
        }
    }
    
}


</script>
