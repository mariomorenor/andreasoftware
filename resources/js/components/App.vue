<template>
  <div>
    <navbar-component v-if="isAuth"></navbar-component>
    <div>
      <router-view></router-view>
    </div>
  </div>
</template>

<script>



export default {
  
mounted() {
   this.$store.commit('checkUser','init');
  if (this.isAuth) {
      this.$router.push({name:'banks'});
  } else {
      this.$router.push({name:'login'});
  }
},
computed: {
  isAuth(){
    return this.$store.state.isAuth;
  }
},


}
</script>

<style>

</style>