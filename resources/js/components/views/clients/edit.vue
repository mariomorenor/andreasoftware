<template>
   <div class="container">
      <form action="#" id="formClientUpdate" method="post">
          <h1 id="title">Datos Cliente</h1>
          <div class="row">
              <div class="col-6">
                  <div class="form-group">
                      <label for="name" class="font-weight-bold">Nombres:</label>
                      <input type="text" class="form-control" name="name" :value="this.$route.params.client.name" >
                  </div>
                  <div class="form-group">
                      <label for="last_name" class="font-weight-bold">Apellidos:</label>
                      <input type="text" class="form-control" :value="this.$route.params.client.last_name" name="last_name">
                  </div>
                  <div class="form-group">
                      <label for="identifier" class="font-weight-bold">Cédula/Ruc:</label>
                      <input type="text" class="form-control" :value="this.$route.params.client.cedula" name="cedula">
                  </div>
              </div>
              <div class="col-6">
                  <div class="form-group">
                      <label for="address" class="font-weight-bold">Dirección:</label>
                      <input type="text" class="form-control" :value="this.$route.params.client.address" name="address">
                  </div>
                  <div class="form-group">
                      <label for="phone" class="font-weight-bold">Teléfono:</label>
                      <input type="text" class="form-control" :value="this.$route.params.client.phone" name="phone">
                  </div>
                  <div class="form-group">
                      <label for="email" class="font-weight-bold">Correo:</label>
                      <input type="text" class="form-control" :value="this.$route.params.client.email" name="email">
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-7 mt-3 mx-auto">
                  <button type="button" @click="updateClient()" class="btn btn-success btn-block btnModificar">GUARDAR</button>
              </div>
          </div>
      </form>
  </div>
</template>

<script>
export default {
    mounted() {
        
    },
methods: {
    updateClient(){
        axios.put('/clients/'+this.$route.params.client.id,$('#formClientUpdate').serialize())
             .then((data)=>{
                 console.log(data);
            if (Number(data.data[0])==23000 && data.data[1] == 1062) {
               Swal.fire({
                   icon:'error',
                   title: 'Error',
                   text:'El Código que intenta ingresar ya existe',
                   timer:1500
               })
            }
            if (Number(data.data[0])==23000 && data.data[1] == 1048) {
                Swal.fire({
                   icon:'error',
                   title: 'Error',
                   text:'Verifique que todos los campos estén llenos y correctamente ingresados',
                   timer:2500
               })
            }
            if (data.data[0] =='HY000' && data.data[1] == 1366) {
                Swal.fire({
                   icon:'error',
                   title: 'Error',
                   text:'Verifique que todos los campos estén llenos y correctamente ingresados',
                   timer:2500
               })
            }
            if (data.data == 'ok') {
                Swal.fire({
                   icon:'success',
                   title: 'Cliente Agregado Correctamente!',
                   timer:1500
               })
               this.$router.push({name:'clients'})
            }
             })
             .catch((error)=>{
                 console.log(error)
             })
    }
},
}
</script>

<style>
#formClientUpdate{
    width: 30rem;
    margin-left: auto;
    margin-right: auto;
}

#title{
    text-shadow: 2px 2px rgb(75, 158, 93);
    color: rgb(2, 2, 2);
}
#formClientUpdate{
  width: 50rem;
  background: whitesmoke;
  padding: 2rem 3rem;
  border-radius: 1.5rem;
  margin-top: 5rem;
}
@media screen and (max-width: 1366px){
    #formClientUpdate{
        margin-top: 1rem;
    }
}
</style>