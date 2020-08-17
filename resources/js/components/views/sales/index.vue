<template>
  <div class="container" id="MainSales">
      <div class="card shadow-lg">
          <div class="card-body">
              <form action="#">
                  <div class="row">
                      <div class="col">
                          <div class="form-group">
                              <label for="cedula" class="font-weight-bold">Cédula/Ruc:</label>
                              <div class="d-flex">
                                  <input type="text" name="cedula" autofocus id="cedula" v-model="ci" autocomplete="off"
                                      class="form-control" required>
                                  <button type="button" @click="checkClient()" data-toggle="tooltip"
                                      data-placement="top" title="Confirmar Cédula"
                                      class="btn btn-outline-success ml-2"><i class="fas fa-check-circle"></i></button>
                                  <div v-show="userExist">
                                      <router-link class="btn btn-outline-primary ml-1" data-toggle="tooltip"
                                          title="Modificar Usuario" data-placement="top"
                                          :to="{name:'editClient', params:{client}}"><i class="fas fa-edit"></i>
                                      </router-link>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="address" class="font-weight-bold">Dirección:</label>
                              <input type="text" name="address" id="address" autocomplete="off" :readonly="userExist"
                                  class="form-control" v-model="address" required>
                          </div>
                      </div>
                      <div class="col">
                          <div class="form-group">
                              <label for="name" class="font-weight-bold">Nombres:</label>
                              <input type="text" name="name" id="name" autocomplete="off" :readonly="userExist"
                                  v-model="name" class="form-control" required>
                          </div>
                          <div class="d-flex">
                              <div class="form-group">
                                  <label for="phone" class="font-weight-bold">Teléfono:</label>
                                  <input type="text" name="phone" id="phone" autocomplete="off" :readonly="userExist"
                                      v-model="phone" class="form-control" required>
                              </div>
                              <div class="form-group ml-2">
                                  <label for="email" class="font-weight-bold">E-mail:</label>
                                  <input type="text" name="email" id="email" autocomplete="off" :readonly="userExist"
                                      v-model="email" class="form-control">
                              </div>
                          </div>
                      </div>
                      <div class="col">
                          <div class="form-group">
                              <label for="" class="font-weight-bold">Apellidos:</label>
                              <input type="text" name="last_name" id="last_name" autocomplete="off"
                                  :readonly="userExist" v-model="last_name" class="form-control" required>
                          </div>
                          <div class="form-group">
                              <label for="date" class="font-weight-bold">Fecha:</label>
                              <input type="date" name="date" id="date" v-model="date" class="form-control" required>

                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col">
                          <div id="toolbarTableSales">
                            <label for="" class="font-weight-bold my-auto">Forma de Pago:</label>
                              <div class="d-flex">
                                  <div class="form-group d-flex">
                                      <label for="cash"  class="my-auto mx-2">Efectivo</label>
                                      <input type="radio" :disabled="tableActive" name="payment_type" v-model="payment" value="cash" id="cash" required>
                                  </div>
                                  <div class="form-group d-flex">
                                      <label for="promo" class="my-auto mx-2">Promoción</label>
                                      <input type="radio" :disabled="tableActive" name="payment_type" v-model="payment" value="promo" id="promo" required>
                                  </div>
                                  <div class="form-group d-flex mr-3">
                                      <label for="credit" class="my-auto mx-2">Crédito</label>
                                      <input type="radio" :disabled="tableActive" name="payment_type" v-model="payment" value="credit" id="credit" required>
                                  </div>
                                  <button @click="addProduct()" type="button" class="btn btn-secondary">Agregar</button>
                                  <input type="text" :disabled="!payment" data-toggle="tooltip" data-placement="top" :title="!payment?'Seleccione un Método de pago':''" @keyup="getProduct()" v-on:keyup.enter="addProduct()" v-model="inputProduct" list="productList" class="form-control ml-2" ref="inputProduct"  autocomplete="off">
                                  <label for="" class="font-weight-bold my-auto mx-2">Cantidad:</label>
                                  <input type="number" :disabled="!payment" class="form-control" v-on:keyup.enter="addProduct()"  style="width:3.5rem" min="1" step="1" v-model="quantity">
                                  <datalist id="productList">
                                      <option v-for="(product) in productList" :value="product.name" :key="product.id">{{product.name}}</option>
                                  </datalist>
                                  <button title="Vaciar Tabla" data-toggle="tooltip" data-placement="top"  type="button" class="btn btn-danger" @click="deleteTable()"><i class="fas fa-trash-alt"></i></button>
                              </div>
                          </div>
                          <table id="tableSale" class="table table-striped table-bordered table-hover"
                              data-toolbar="#toolbarTableSales">
                              <thead class="thead-dark">
                                  <tr>
                                      <th data-field="id" data-visible="false"></th>
                                      <th data-field="acciones" data-width="55" data-formatter="salesAccionesFormatter"></th>
                                      <th data-field="product" data-align="center" data-width="380">Detalle</th>
                                      <th data-field="quantity" data-align="center" data-width="50">Cantidad</th>
                                      <th data-field="pvp" data-align="center" data-width="50">Valor Unitario</th>
                                      <th data-field="pvpTotal" data-align="center" data-width="50">Valor Total</th>
                                  </tr>
                              </thead>
                          </table>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</template>

<script>
export default {

    data() {
        return {
            ci:'',
            name: '',
            last_name: '',
            address: '',
            phone: '',
            email: '',
            date: '',
            userExist: false,
            client: '',
            productList: '',
            inputProduct: '',
            productVoucher:'',
            quantity:1,
            payment:false,
            tableActive:false

        }
    },
    mounted() {
        this.init()
        this.deleteTable();
    },
    beforeMount() {
        this.date = moment().format('YYYY-MM-DD');
    },
    methods: {
        deleteTable(){
            console.log('a')
            $('#tableSale').bootstrapTable('removeAll')
        },
        init() {
            $('#tableSale').bootstrapTable({
                height:'500'
            });
        },
        checkClient() {
            if (this.ci == '') {
                Swal.fire('La cédula no puede estár vacía', '','error')
            } else {
                  axios.get('/clients/1', {
                    params: {
                        cedula: $('#cedula').val()
                    }
                })
                .then(({
                    data
                }) => {
                    if (data) {
                        this.name = data.name;
                        this.last_name = data.last_name;
                        this.address = data.address;
                        this.phone = data.phone;
                        this.email = data.email;
                        this.userExist = true;
                        this.client = data
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No existe datos para la cédula ingresada!',
                            timer: 1000
                        });
                        this.name = '';
                        this.last_name = '';
                        this.address = '';
                        this.phone = '';
                        this.email = '';
                        this.userExist = false;
                        this.client = '';
                    }
                })
                .catch((error) => {
                    console.log(error)
                });
            }
          
        },
        getProduct() {
                axios.get('/products', {
                        params: {
                            product: this.inputProduct
                        }
                    })
                    .then(({
                        data
                    }) => {
                        this.productList = data.map(function (product) {
                            
                            let new_product = {
                                name: product.name,
                                id: product.id,
                                code: product.code,
                                cash:product.prices.cash,
                                promo: product.prices.promo,
                                credit: product.prices.credit,

                            }
                            return new_product;
                        });
                    })
                    .catch((error) => {
                        console.log(error)
                    });
        },
        addProduct(){
            let productExists = false;
            let product = '';
            let pvp=0;
            for (let index = 0; index < this.productList.length; index++) {
                if (this.productList[index].name == this.inputProduct) {
                    productExists = true;
                    product = this.productList[index];
                    break;
                }
            }
           
            if (productExists ) {
                
                switch (this.payment) {
                    case 'cash':
                        pvp = product.cash;
                        break;
                    case 'promo':
                         pvp = product.promo;
                        break;
                    case 'credit':
                         pvp = product.credit;
                        break;
                
                    default:
                        break;
                }

                $('#tableSale').bootstrapTable('insertRow',{
                    index: $('#tableSale').bootstrapTable('getOptions').totalRows+1,
                    row:{
                        product: product.name,
                        id: product.id,
                        quantity:this.quantity,
                        acciones:'x',
                        pvp:pvp


                    }
                }) 

                this.quantity = 1;
                this.inputProduct = ''
                this.totalRows();
                this.$refs.inputProduct.focus()
            }

        },
        totalRows(){
           this.tableActive = $('#tableSale').bootstrapTable("getOptions").totalRows > 0? true:false;
        }

    },


}
</script>

<style>
#MainSales{
    margin-bottom: 5rem;
}
.card{
    width: 80%;
    margin-left: auto;
    margin-right: auto;
    margin-top: 1rem;
}

@media screen and (min-width: 1367px) {
    .card{
    width: 100%;
    margin-left: auto;
    margin-right: auto;
}
}
</style>