<template>
    <div>List Events</div>
</template>

<script>
import Event from '../apis/Events'
export default {
    mounted(){
        Event.list_events().then((response) => {
            console.log(response)
        }).catch((error) => {
            if(error.response.status === 401){
                this.$store.commit('setLogout')
                localStorage.removeItem("token")
                this.$router.push({name:"login"})
            }
        })
    }
}
</script>

<style>

</style>