<template>

      <div class="containerProducto">
          <h1 id="title">Detalles Producto</h1>
          <div class="row">
              <div class="col">
                  <div class="form-group d-flex">
                      <label for="name" class="my-auto font-weight-bold mr-2">Producto:</label>
                      <input type="text" v-model="product" name="name" placeholder="Nombre del Producto"
                          class="form-control">
                  </div>
                  <div class="form-group d-flex">
                      <label for="code" class="font-weight-bold mr-2 my-auto">Código:</label>
                      <input type="text" v-model="code" name="code" placeholder="Ingrese el Código"
                          class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="description" class="font-weight-bold">Descripción</label>
                      <textarea name="description" v-model="description" placeholder="Características, detalles, etc."
                          id="description" cols="30" rows="3" class="form-control"></textarea>
                  </div>
              </div>
              <div class="col">
                  <div class="row">
                      <div class="col">
                          <div class="form-group">
                              <label for="" class="font-weight-bold">Efectivo:</label>
                              <input name="cash" step="0.01" v-model="cash" type="number" class="form-control">
                          </div>
                          <div class="form-group">
                              <label for="costo" class="font-weight-bold">Costo:</label>
                              <input name="cost" step="0.01" v-model="cost" type="number" class="form-control">
                          </div>
                      </div>
                      <div class="col">
                          <div class="form-group">
                              <label for="" class="font-weight-bold">Promoción:</label>
                              <input name="promo" step="0.01" v-model="promo" type="number" class="form-control">
                          </div>
                          <div class="form-group">
                              <label for="" class="font-weight-bold">Stock:</label>
                              <input name="stock" v-model="stock" type="number" class="form-control">
                          </div>
                      </div>
                      <div class="col">
                          <div class="form-group">
                              <label for="" class="font-weight-bold">Crédito:</label>
                              <input name="credit" step="0.01" v-model="credit" type="number" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="form-group mt-3">
                      <button  type="button" @click="updateProduct()" class="btn btn-success btn-block btnModificar">ACTUALIZAR</button>
                  </div>
              </div>
          </div>
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
      this.getProduct()
  },
  methods: {
    updateProduct(){
        let that = this;
        Swal.fire({
        icon: 'warning',
        title:'¿Seguro de Actualizar este producto?',
        showCancelButton: true,
        cancelButtonText:'Cancelar',
        confirmButtonText:'Sí, Seguro',
        cancelButtonColor: 'green',
        confirmButtonColor:'red'
        }).then((result)=>{
        if (result.value) {
            axios.put('/products/'+that.$route.params.producto.id,{
                name:that.product,
                code:that.code,
                description:that.description,
                cash:that.cash,
                promo:that.promo,
                credit:that.credit,
                stock:that.stock,
                cost:that.cost
            }).then((data)=>{
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
                   title: 'Producto Actualizado Correctamente!',
                   timer:1500
               })
               
            }
            }).catch((error)=>{
                console.log(error)
            })
        }
        });
    },
    getProduct(){
        this.product = this.$route.params.producto.name;
        this.code = this.$route.params.producto.code;
        this.description = this.$route.params.producto.description;
        this.cash = this.$route.params.producto.prices.cash;
        this.promo = this.$route.params.producto.prices.promo;
        this.credit = this.$route.params.producto.prices.credit;
        this.cost = this.$route.params.producto.prices.cost;
        this.stock = this.$route.params.producto.prices.stock;
    }
  },
}
</script>

<style>
.containerProducto{
  width: 50rem;
  background: whitesmoke;
  margin: auto;
  margin-top: 5rem;
  padding: 2rem 3rem;
  border-radius: 1.5rem;
}
@media screen and (max-width: 1366px){
    .containerProducto{
        margin-top: 1rem;
    }
}

.btnModificar:hover, .btnModificar:active {
  background-color: rgb(141, 35, 141);
  border: 1px solid rgb(141, 35, 141);
}
</style>