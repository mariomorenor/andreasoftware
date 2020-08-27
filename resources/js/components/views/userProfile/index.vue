<template>
  <div class="mainUser">
      <h2 class="text-center mt-2 font-weight-bold">Datos de Usuario</h2>
      <div class="panel shadow-lg border border-dark  mx-auto">
          <div class="row">
              <div class="form-group col-6">
                  <label for="name">Nombre:</label>
                  <input class="form-control" type="text" name="name" id="name" readonly
                      :value="$store.state.user.name">
              </div>
              <div class="form-group col-6">
                  <label for="username">Usuario:</label>
                  <input class="form-control" type="text" v-model="username" name="username" id="username" autocomplete="off">
                  <span v-if="errors.username" class="text-danger">{{errors.username[0]}}</span>
              </div>
          </div>
          <div class="row">
                  <div class="form-group col-6">
                      <label for="password">Contraseña:</label>
                      <input class="form-control" type="password" v-model="password" name="password" id="password" autocomplete="off"
                          value="1234567890">
                        <span v-if="errors.password" class="text-danger">{{errors.password[0]}}</span>
                  </div>
                  <div class="form-group col-6">
                      <label for="confirm_password">Confirmar Contraseña:</label>
                      <input class="form-control" type="password" v-model="confirm" name="confirm_password" id="confirm_password" autocomplete="off">
                  </div>
          
          </div>
          <div class="row mt-3">
              <div class="col-5 mx-auto">
                  <button type="button" @click="updateUser()" class="btn btn-success btn-block">ACTUALIZAR DATOS</button>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
data() {
    return {
        username:'',
        password:123456789,
        confirm:123456789,
        errors:''
    }
},
mounted() {
    this.username = this.$store.state.user.username
},
methods: {
    updateUser(){
        axios.put('user-profile/'+this.$store.state.user.id,{
            username: this.username,
            password:this.password,
            password_confirmation: this.confirm
        })
             .then((data)=>{
                 console.log(data)
                  this.$store.commit('getUser');
                 Swal.fire({
                     icon:'success',
                     title:'Operación Realizada Correctamente!',
                     timer:1500
                 })
                 this.errors = []
             })
             .catch((error)=>{
                 console.log(error.response.data)
                 this.errors = error.response.data.errors;
             });
     
    }
},
}
</script>

<style>
.panel{
    margin-top: 1rem;
    width: 40rem;
    /* background: rgba(0, 113, 158, 0.356); */
    border-radius: 0.8rem;
    padding: 2rem;
}


</style>