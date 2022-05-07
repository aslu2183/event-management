<template>
    <div>
        <SideBar></SideBar>
        <div class="wrapper d-flex flex-column min-vh-100 bg-light">
            <Header></Header>
            <div class="body flex-grow-1 px-3">
                <CContainer lg>
                    <router-view></router-view>
                </CContainer>
            </div>
        </div>    
    </div>
</template>

<script>
import SideBar from '../components/SideBar.vue'
import Header from '../components/Header.vue'
import User from '../apis/Users'
export default {
    name:"HomeView",
    components : {
        SideBar,
        Header
    },
    mounted(){
        User.getUser().then((response) => {
            console.log(response);
        })
        .catch((error) => {
            if(error.response.status === 401){
                this.$store.commit('setLogout')
                localStorage.removeItem("token")
                this.$router.push({name:"login"})
            }
        })
    }
}
</script>