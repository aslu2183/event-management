<template>
    
    <CSidebar 
        position="fixed"
        :visible="isVisible"
        @visible-change="change_visible"
    >
        <CSidebarBrand>Sidebar Brand </CSidebarBrand>
        <CSidebarNav>
            <li class="nav-title">DashBoard</li>
            <router-link :to="{'name':'login'}" style="text-decoration:none">
                <CNavItem href="#">
                    <CIcon  customClassName="nav-icon" icon="cil-home"/>
                        Home
                </CNavItem>
            </router-link>
            
            <CNavGroup>
                <template #togglerContent>
                    <CIcon  customClassName="nav-icon" icon="cil-puzzle"/> Events
                </template>
                <CNavItem href="#">
                    <CIcon  customClassName="nav-icon" icon="cil-note-add"/> Create Event
                </CNavItem>
                <CNavItem href="#">
                    <CIcon  customClassName="nav-icon" icon="cil-puzzle"/> List Events
                </CNavItem>
            </CNavGroup>

            <CNavGroup>
                <template #togglerContent>
                    <CIcon  customClassName="nav-icon" icon="cil-puzzle"/> Bookings
                </template>
                <CNavItem href="#">
                    <CIcon  customClassName="nav-icon" icon="cil-note-add"/> Create Booking
                </CNavItem>
                <CNavItem href="#">
                    <CIcon  customClassName="nav-icon" icon="cil-puzzle"/> List Bookings
                </CNavItem>
            </CNavGroup>

            <CNavGroup>
                <template #togglerContent>
                    <CIcon  customClassName="nav-icon" icon="cil-puzzle"/> Reports
                </template>
                <CNavItem href="#">
                    <CIcon  customClassName="nav-icon" icon="cil-puzzle"/> Sales Report
                </CNavItem>
                <!-- <CNavItem href="#">
                    <CIcon  customClassName="nav-icon" icon="cil-puzzle"/> List Bookings
                </CNavItem> -->
            </CNavGroup>
        </CSidebarNav>
        
    </CSidebar>
    
</template>

<script>
export default {
    name : "SideBar",
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
