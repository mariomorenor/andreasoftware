<template>
  <div>
      <nav class="navbar">
          <div class="mx-auto d-flex">
              <div class="text-center mx-1">
                  <router-link class="linkButton" :to="{name:'inventory'}">
                      <img src="/img/inventory/imgInventory4.png" class="navbarMenuOption rounded-circle shadow" alt="">
                      <p class="font-weight-bold">Inventario</p>
                  </router-link>
              </div>
              <div class="text-center mx-1">
                  <router-link class="linkButton" :to="{name:'sales'}">
                      <img src="/img/sales/imgSales3.png"  class="navbarMenuOption rounded-circle shadow" alt="">
                      <p class="font-weight-bold">Ventas</p>
                  </router-link>
              </div>
              <div class="text-center mx-1">
                  <router-link class="linkButton" :to="{name:'banks'}">
                      <img src="/img/banks/imgBanks2.png" style="padding:0.2rem" class="navbarMenuOption rounded-circle shadow" alt="">
                      <p class="font-weight-bold">Bancos</p>
                  </router-link>
              </div>
              <div class="text-center mx-1">
                  <router-link class="linkButton" :to="{name:'accounts'}">
                      <img src="/img/accounts/imgAccounts.png" style="padding:0.3rem" class="navbarMenuOption rounded-circle shadow" alt="">
                      <p class="font-weight-bold">Cuentas</p>
                  </router-link>
              </div>
              <div class="text-center mx-1">
                  <router-link class="linkButton" :to="{name:'clients'}">
                      <img src="/img/clients/imgClients2.png" style="background:white" class="navbarMenuOption rounded-circle shadow" alt="">
                      <p class="font-weight-bold">Clientes</p>
                  </router-link>
              </div>
              <div class="text-center mx-1">
                  <router-link class="linkButton" :to="{name:'sellers'}">
                      <img src="/img/clients/imgClients2.png" style="background:white" class="navbarMenuOption rounded-circle shadow" alt="">
                      <p class="font-weight-bold">Colaboradores</p>
                  </router-link>
              </div>
              <div class="text-center mx-1">
                  <router-link class="linkButton" :to="{name:'vouchers'}">
                      <img src="/img/vouchers/imgVoucher3.png" class="navbarMenuOption rounded-circle shadow" alt="">
                      <p class="font-weight-bold">Comprobantes</p>
                  </router-link>
              </div>
          </div>
          <div class="d-flex"> 
              <div class="text-center mx-1">
                  <router-link :to="{name:'users'}">
                      <img src="/img/user/imgUserProfile2.png"  class="navbarMenuOption rounded-circle shadow" alt="">
                      <p class="font-weight-bold">{{this.$store.state.user.name}} </p>
                  </router-link>
                 
              </div>
              <div class="mt-3">
                   <button type="button" data-toggle="tooltip" data-placement="left" title="Cerrar Sesión" @click="logout()" class="btn btn-dark mt-5 ml-2"><i class="fas fa-sign-out-alt"></i></button>
              </div>
          </div>
      </nav>
  </div>
</template>

<script>
export default {
    mounted() {
    },
    methods: {
        logout(){
            axios.get('/logout').then((response)=>{
                this.$store.commit('getUser');
                this.$router.push({name:'login'});
            });
        }
    },
}
</script>

<style>
.navbar{
    background: rgb(123, 190, 157);
  max-height: 120px; 
}
/* Boton */
.navbarMenuOption{
    width: 5rem;
    margin-left: 1rem;
    margin-right: 1rem;
    transition: all 0.3s;
    background: rgb(255, 255, 255);

}
.navbarMenuOption:hover{
    transform: scale(1.2);
    
}
.linkButton{
color: rgb(15, 132, 161);
text-shadow: 1px 1px white;
}

a:hover{
    text-decoration: none;
       color: rgb(19, 18, 18);
}
.router-link-active{
    color: rgb(19, 18, 18);
}
</style>