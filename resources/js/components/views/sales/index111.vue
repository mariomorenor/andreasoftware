    <template>
  <div class="body-formulario">
    <div class="formulario">

        <h4 class="title-form">Facturación</h4>

        <form action="#">
            <div class="row">
                <div class="col">

                    <div class="text-right">                        
                        <label for="vendedor" class="label-form">Vendedor: </label>
                        {{this.$store.state.user.name}}
                    </div>
                    <hr>
                    <h5 class="title-form-group">Cliente</h5>
                    <div class="form-group">                        
                        <label for="cedula" class="label-form">Cédula/RUC: </label> &nbsp;
                        <input type="text" name="cedula" id="cedula" size="30" class="form-control" pattern="[0-9]+" required>
                        &nbsp;<button type="button" @click="checkClient()" data-toggle="tooltip"
                        data-placement="top" title="Confirmar Cédula" class="btn btn-outline-success btn-form">
                        <i class="fas fa-check-circle"></i></button>
                        <div v-show="userExist">
                            <router-link class="btn btn-outline-primary ml-1" data-toggle="tooltip"
                                title="Modificar Usuario" data-placement="top"
                                :to="{name:'editClient', params:{client}}"><i class="fas fa-edit"></i>
                            </router-link>
                        </div>
                        <div class="invalid-feedback">
                            Ingrese un número de cédula
                        </div>

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

                    </div><br>            
                
                    <div class="form-group">
                        <label for="name" class="label-form">Nombres: </label>&nbsp;
                        <input type="text" name="name" id="name" size="30" class="form-control" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s ]+" required>
                        <div class="invalid-feedback">
                            Ingrese los nombres
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label for="last-name" class="label-form">Apellidos: </label>&nbsp;
                        <input type="text" name="last-name" id="last-name" size="30" class="form-control" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s ]+" required>
                        <div class="invalid-feedback">
                            Ingrese los apellidos
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label for="address" class="label-form">Dirección: </label>&nbsp;
                        <input type="text" name="address" id="address" size="30" class="form-control" required>
                        <div class="invalid-feedback">
                            Ingrese una dirección
                        </div>
                    </div>
                                
                    <div class="form-group">
                        <label for="phone" class="label-form">Teléfono: </label>&nbsp;
                        <input type="text" name="phone" id="phone" size="35" class="form-control" pattern="[0-9]+" required>
                        <div class="invalid-feedback">
                            Ingrese una teléfono
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label for="email" class="label-form">Email: </label>&nbsp;
                        <input type="text" name="email" id="email" size="40" class="form-control" required>
                        <div class="invalid-feedback">
                            Ingrese una e-mail
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label for="date" class="label-form">Fecha: </label>&nbsp;
                        <input type="date" name="date" id="date" v-model="date" size="35" class="form-control" required>
                    </div>
                    <hr>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group vertical-line">  
                        <h5 class="title-form-group">Venta</h5>
                        
                        <div class="vertical-line-content">
                            <label for="pagos" class="label-form">Métodos de pago: </label>&nbsp;
                            <label for="cash">Efectivo</label>&nbsp;&nbsp;
                            <input type="radio" :disabled="tableActive" name="payment_type" v-model="payment" value="cash" id="cash" required>&nbsp;&nbsp;
                            
                            <label for="promo">Promoción</label>&nbsp;&nbsp;
                            <input type="radio" :disabled="tableActive" name="payment_type" v-model="payment" value="promo" id="promo" required>&nbsp;&nbsp;

                            <label for="credit">Crédito</label>&nbsp;&nbsp;
                            <input type="radio" :disabled="tableActive" name="payment_type" v-model="payment" value="credit" id="credit" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <h5 class="title-form-group">Productos</h5>

                        <div class="vertical-line-content">
                            <button type="button" class="btn btn-secondary">Agregar</button>
                            <input type="text" :disabled="!payment">
                            <label for="cantidad" class="label-form">Cantidad: </label>
                            <input type="number" min="1" style="width: 50px">
                            <button type="button" class="btn btn-danger" title="Vaciar tabla"><i class="fas fa-trash-alt"></i></button>
                        </div>                        
                    </div>
                    <hr>

                    <table id="tableSale" class="table table-striped table-bordered table-hover" data-toolbar="#toolbarTableSales">
                        
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
</template>

<!--<script>
export default {};

</script>-->

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
                Swal.fire('La cédula no puede estar vacía', '','error')
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

.formulario {
    margin: 1rem auto 0;
    max-width: 1100px;
    background: white;
    border: 1px solid rgb(19, 18, 18);
    padding: 1rem;
    box-shadow: 3px 3px 3px 3px rgb(123, 190, 157);
    border-radius: 15px;
}

.title-form{
    text-align: center;
    font-weight: bold;
}

hr{
    background: rgb(123, 190, 157);
}

.label-form{
    font-weight: bold;
}

.title-form-group{
    font-weight: bold;
}

.form-group{
    display: inline-flex;
}

.vertical-line{
    border-right: 2px solid rgb(123, 190, 157);
    padding-right: 90px;
    height: 70px;
}

.vertical-line-content::before{
    content: '\A';
    white-space: pre;
}

.form-control{
    display: inline-block;
}
</style> 