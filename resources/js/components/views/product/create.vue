<template>
  <div class="container">
      <form action="#" id="formCreateProduct" class="shadow-lg mx-auto" enctype="multipart/form-data">
          <h1 id="title">Nuevo Producto</h1>
          <div class="row">
              <div class="col">
                  <div class="form-group d-flex">
                      <label for="name" class="my-auto font-weight-bold mr-2">Producto:</label>
                      <input type="text" v-model="product" name="name" placeholder="Nombre del Producto" class="form-control">
                  </div>
                  <div class="form-group d-flex">
                      <label for="code" class="font-weight-bold mr-2 my-auto">Código:</label>
                      <input type="text" v-model="code" name="code" placeholder="Ingrese el Código"
                          class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="description" class="font-weight-bold">Descripción</label>
                      <textarea name="description" v-model="description" placeholder="Características, detalles, etc." id="description"
                          cols="30" rows="3" class="form-control"></textarea>
                  </div>
              </div>
              <div class="col">
                  <div class="row">
                      <div class="col">
                          <div class="form-group">
                              <label for="" class="font-weight-bold">Efectivo:</label>
                              <input name="cash" v-model="cash" type="number" class="validarNumeros form-control">
                          </div>
                          <div class="form-group">
                              <label for="costo" class="font-weight-bold">Costo:</label>
                              <input name="cost" v-model="cost" type="number" class="validarNumeros form-control">
                          </div>
                      </div>
                      <div class="col">
                          <div class="form-group">
                              <label for="" class="font-weight-bold">Promoción:</label>
                              <input name="promo" v-model="promo" type="number" class="validarNumeros form-control">
                          </div>
                          <div class="form-group">
                              <label for="" class="font-weight-bold">Stock:</label>
                              <input name="stock" v-model="stock" type="number" class="validarNumeros form-control">
                          </div>
                      </div>
                      <div class="col">
                          <div class="form-group">
                              <label for="" class="font-weight-bold">Crédito:</label>
                              <input name="credit" v-model="credit" type="number" class="validarNumeros form-control">
                          </div>
                      </div>
                  </div>
                  <div class="form-group mt-3">
                      <button type="button" @click="storeProduct()" class="btn btn-success btn-block btnAdd">AGREGAR</button>
                  </div>
              </div>
          </div>
      </form>
  </div>
</template>

<script>
export default {
data() {
    return {
        product:'',
        code:'',
        description:'',
        cash:'',
        promo:'',
        credit:'',
        cost:'',
        stock:''
    }
},
mounted(){
  
    $(function(){
        $(".validarNumeros").keydown(function(event){
            if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
                return false;
            }
        });
    });

},
methods: {
    storeProduct(){

        axios.post('/products',{
                name:this.product,
                code:this.code,
                description:this.description,
                cash:this.cash,
                promo:this.promo,
                credit:this.credit,
                stock:this.stock,
                cost:this.cost
                })
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
     
            if (data.data == 'ok') {
                                Swal.fire({
                   icon:'success',
                   title: 'Producto Ingresado Correctamente!',
                   timer:1500
               })
               this.$router.push({name:'inventory'})
            }

        })
        .catch((error)=>{
            console.log(error)
        });
    }
},
}
</script>

<style>
#formCreateProduct{
  width: 50rem;
  background: whitesmoke;
  padding: 2rem 3rem;
  border-radius: 1.5rem;
  margin-top: 5rem;
}
@media screen and (max-width: 1366px){
    #formCreateProduct{
        margin-top: 1rem;
    }
}
#title{
    text-shadow: 2px 2px rgb(75, 158, 93);
    color: rgb(2, 2, 2);
}
.btnAdd:hover{
      background-color: rgb(141, 35, 141);
  border: 1px solid rgb(141, 35, 141);
}
</style>