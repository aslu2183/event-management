<template>
  <div v-if="isLoggedIn">
    <HomeView></HomeView>
  </div>
  <div v-else>
    <router-view/>
  </div>
</template>

<style lang="scss">
// Import Main styles for this application
@import 'styles/style';
</style>

<script>
import HomeView from './views/HomeView.vue'
export default {
  computed : {
    isLoggedIn(){
      return this.$store.state.isLoggedIn
    }
  },
  components : {
    HomeView
  }
}
</script>


