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
   this.$store.commit('getUser');
   let that = this;
    setTimeout(() => {
      that.redirect();
    }, 500);
},
methods: {
  redirect(){
      if (this.isAuth) {
      this.$router.push({name:'inventory'});
  } else {
      this.$router.push({name:'login'});
  }
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