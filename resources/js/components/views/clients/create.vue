<template>
  <div class="container">
      <form action="#" id="formClient" method="post">
          <h1 id="title">Datos Cliente</h1>
          <div class="row">
              <div class="col-6">
                  <div class="form-group">
                      <label for="name" class="font-weight-bold">Nombres:</label>
                      <input type="text" class="validarLetras form-control" name="name" >
                  </div>
                  <div class="form-group">
                      <label for="last_name" class="font-weight-bold">Apellidos:</label>
                      <input type="text" class="validarLetras form-control" name="last_name">
                  </div>
                  <div class="form-group">
                      <label for="identifier" class="font-weight-bold">Cédula/Ruc:</label>
                      <input type="text" class="validarNumeros form-control"  name="cedula">
                  </div>
              </div>
              <div class="col-6">
                  <div class="form-group">
                      <label for="address" class="font-weight-bold">Dirección:</label>
                      <input type="text" class="form-control" name="address">
                  </div>
                  <div class="form-group">
                      <label for="phone" class="font-weight-bold">Teléfono:</label>
                      <input type="text" class="validarNumeros form-control"  name="phone">
                  </div>
                  <div class="form-group">
                      <label for="email" class="font-weight-bold">Correo:</label>
                      <input type="text" class="form-control" name="email">
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-7 mt-3 mx-auto">
                  <button type="button" @click="storeClient()" class="btn btn-success btn-block btnModificar">GUARDAR</button>
              </div>
          </div>
      </form>
  </div>
</template>

<script>
export default {
mounted(){
    
    $(function(){
        $(".validarNumeros").keydown(function(event){
            if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
                return false;
            }
            });
    });

    $(function(){
        $(".validarLetras").keydown(function(event){
            if(event.keyCode >= 48 && event.keyCode <= 57){
                return false;
            }
        });
    });
},
methods: {
    storeClient(){
        axios.post('/clients',$('#formClient').serialize())
             .then((data)=>{
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
             });
    }
},
}
</script>

<style>
#formClient{
    width: 30rem;
    margin-left: auto;
    margin-right: auto;
}

#title{
    text-shadow: 2px 2px rgb(75, 158, 93);
    color: rgb(2, 2, 2);
}
#formClient{
  width: 50rem;
  background: whitesmoke;
  padding: 2rem 3rem;
  border-radius: 1.5rem;
  margin-top: 5rem;
}
@media screen and (max-width: 1366px){
    #formClient{
        margin-top: 1rem;
    }
}

</style>