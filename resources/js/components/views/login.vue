<template>
  <div>
      <div class=" contenedor">
        <form id="formLogin" class="shadow-lg" action="#">
          <div class="form-group">
            <div class="rounded-circle justify-content-center d-flex">
            <img id="imgLogin"  src="/img/login/imgLogin.png" alt="">
            </div>
          </div>
          <div class="form-group">
            <label for="username">Usuario:</label>
            <input type="text" v-model="username" name="username" class="form-control">
          </div>
          <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" v-model="password" class="form-control">
          </div>
          <div class="form-group mb-0">
            <button type="button" @click="login()" class="btn btn-block btn-success shadow mt-4">Iniciar Sesión</button>
          </div>
        </form>
      </div>
      <div class="d-flex justify-content-center">
        <p id="software_name" class="" >Andrea's Software</p>
      </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      username:'',
      password:''
    }
  },
methods: {
  login(){
    axios.post('login',{
      username:this.username,
      password:this.password
    })
    .then((response)=>{
      this.$store.commit('checkUser',response);
      this.$router.push({name:'inventory'});
    })
    .catch((error)=>{
      console.log(error)
    });
  }
},
}
</script>

<style>
#imgLogin{
  width: 12rem;

}
#formLogin{
  width: 30rem;
  background: white;
  padding: 3rem;
  border-radius: 1.8rem;
  
}
  .contenedor{
  height: 100%;
  align-items: center;
  justify-content: center;
  display: flex;

}

#software_name{
  font-family: 'Impact';
  color: #686868;
  font-size: 1.5rem;
  /* text-shadow: 1.5px 1.5px #003a47; */

}

@media screen and (max-width: 1366px){
  
.contenedor{
    margin-top: 2rem;
}

#software_name{
 margin-top: 1.5rem;

}

}
@media screen and (min-width: 1367px){
  
.contenedor{
    margin-top: 7rem;
}

#software_name{
 margin-top: 3rem;

}

}



</style>