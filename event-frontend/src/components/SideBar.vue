<template>
    
    <CSidebar 
        position="fixed"
        :visible="isVisible"
        @visible-change="change_visible"
    >
        <CSidebarBrand>Sidebar Brand </CSidebarBrand>
        <CSidebarNav>
            <li class="nav-title">DashBoard</li>
            <router-link :to="{'name':'dashboard'}" style="text-decoration:none">
                <CNavItem href="#">
                    <CIcon  customClassName="nav-icon" icon="cil-home"/>
                        Home
                </CNavItem>
            </router-link>
            
            <CNavGroup>
                <template #togglerContent>
                    <CIcon  customClassName="nav-icon" icon="cil-puzzle"/> Events
                </template>
                <router-link :to="{'name':'add-event'}" style="text-decoration:none">
                    <CNavItem href="#">
                        <CIcon  customClassName="nav-icon" icon="cil-note-add"/> Create Event
                    </CNavItem>
                </router-link>

                <router-link :to="{'name':'list-events'}" style="text-decoration:none">    
                    <CNavItem href="#">
                        <CIcon  customClassName="nav-icon" icon="cil-puzzle"/> List Events
                    </CNavItem>
                </router-link>    
            </CNavGroup>

            <CNavGroup>
                <template #togglerContent>
                    <CIcon  customClassName="nav-icon" icon="cil-puzzle"/> Bookings
                </template>

                <router-link :to="{'name':'new-booking'}" style="text-decoration:none">  
                    <CNavItem href="#">
                        <CIcon  customClassName="nav-icon" icon="cil-note-add"/> Create Booking
                    </CNavItem>
                </router-link>  

                <router-link :to="{'name':'list-booking'}" style="text-decoration:none">   
                    <CNavItem href="#">
                        <CIcon  customClassName="nav-icon" icon="cil-puzzle"/> List Bookings
                    </CNavItem>
                </router-link>    
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
