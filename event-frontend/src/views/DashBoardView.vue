<template>
  <div>
    <SideBar></SideBar>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      <Header></Header>
      <div class="body flex-grow-1 px-3">
        <CContainer lg>
          <div>aLSAM</div>
        </CContainer>
      </div>
    </div>
  </div>  
</template>

<script>
import SideBar from '../components/SideBar.vue'
import Header from '../components/Header.vue'
export default {
    name : "DashBoard",
    components : {
      SideBar,
      Header
    }
}
</script>

<style>

</style>