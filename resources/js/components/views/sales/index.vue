<template>
    <div class="container" id="formulario">
        <div class="container" id="body-form">
            <p class="title-form">Facturación</p>
            <form id="formSale" name="formSale" action="#">
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right">
                            <div class="d-flex">
                                <label for="vendedor" class="font-weight-bold my-auto mr-2">Vendedor: </label>
                                <select name="vendedor" id="vendedor" class="form-control">
                                    <option value="" selected disabled>Seleccione...</option>
                                    <option v-for="vendedor in vendedores" :key="vendedor.id" value="">{{vendedor.name}}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- TODO comenté esto -->
                <dataclient-component></dataclient-component>

                <!-- <p class="title-form-group">Cliente</p>
                <div class="row">
                    <div class="col-md-4 label-container">
                        <label for="cedula" class="font-weight-bold">Cédula/RUC: </label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="cedula" id="cedula" class="validarNumeros form-control" style="width: 73%" v-model="ci"
                            autocomplete="off" required>
                    </div>
                    <div class="col-md-4 button-container">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-outline-success" @click="checkClient()"
                                    title="Confirmar cédula">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            </div>
                            <div class="col-md-6 btn-modify">
                                <div v-show="userExist">
                                    <router-link class="btn btn-outline-primary" title="Modificar Usuario"
                                        :to="{name:'editClient', params:{client}}">
                                        <i class="fas fa-edit"></i>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-1">
                        <label for="name" class="font-weight-bold">Nombres: </label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="name" id="name" class="validarLetras form-control" v-model="name" :readonly="userExist"
                            autocomplete="off" required>
                    </div>
                    <div class="col-md-1">
                        <label for="last-name" class="font-weight-bold">Apellidos: </label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="last_name" id="last_name" class="validarLetras form-control" v-model="last_name"
                            :readonly="userExist" autocomplete="off" required>
                    </div>
                    <div class="col-md-1">
                        <label for="address" class="font-weight-bold">Dirección: </label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="address" id="address" class="form-control" v-model="address"
                            :readonly="userExist" autocomplete="off" required>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-1">
                        <label for="phone" class="font-weight-bold">Teléfono: </label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="phone" id="phone" class="validarNumeros form-control" v-model="phone" :readonly="userExist"
                            autocomplete="off" required>
                    </div>
                    <div class="col-md-1">
                        <label for="email" class="font-weight-bold">E-mail: </label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="email" id="email" class="form-control" v-model="email" :readonly="userExist"
                            autocomplete="off" required>
                    </div>
                    <div class="col-md-1">
                        <label for="date" class="font-weight-bold">Fecha: </label>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="date" id="date" class="form-control" v-model="date" required>
                    </div>
                </div> -->
                <!-- TODO hasta aquí copie -->
                <hr>
                <div class="row">
                    <div class="col-md-6 vertical-line">
                        <p class="title-form-group">Venta</p>
                        <div class="row">
                            <div class="col-md-auto">
                                <label for="pagos" class="font-weight-bold">Formas de pago: </label>
                            </div>
                            <div class="col-md-auto">
                                <label for="cash">Efectivo</label>
                                <input type="radio" name="payment_type" id="cash" value="cash" v-model="payment"
                                    :disabled="tableactive" required>
                            </div>
                            <div class="col-md-auto">
                                <label for="promo">Promoción</label>
                                <input type="radio" name="payment_type" id="promo" value="promo" v-model="payment"
                                    :disabled="tableactive" required>
                            </div>
                            <div class="col-md-auto">
                                <label for="credit">Crédito</label>
                                <input type="radio" name="payment_type" id="credit" value="credit" v-model="payment"
                                    :disabled="tableactive" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p class="title-form-group">Productos</p>
                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success" @click="addProduct()"
                                    :disabled="!payment">
                                    Agregar <i class="fas fa-plus-circle"></i>
                                </button>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" @keyup="getProduct()"
                                    v-on:keyup.enter="addProduct()" v-model="inputProduct" list="productList"
                                    ref="inputProduct" :disabled="!payment"
                                    :title="!payment?'Seleccione un Método de pago':''" autocomplete="off">
                            </div>
                            <div class="col-md-2">
                                <label for="cantidad" class="font-weight-bold">Cantidad: </label>
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="validarNumeros form-control" v-on:keyup.enter="addProduct()" min="1"
                                    step="1" v-model="quantity" :disabled="!payment" required>
                                <datalist id="productList">
                                    <option v-for="(product) in productList" :value="product.name+'['+product.code+']' "
                                        :key="product.id">{{product.name}}</option>
                                </datalist>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="tableSale" data-show-footer="true"
                            class="table table-striped table-bordered table-hover" data-toolbar="#toolbarTableSales">
                            <thead class="thead-dark">
                                <tr>
                                    <th data-field="id" data-visible="false"></th>
                                    <th data-field="acciones" data-events="operateEventsSale" data-width="55"
                                        data-formatter="salesAccionesFormatter"></th>
                                    <th data-field="code" data-width="100">Código</th>
                                    <th data-field="product" data-align="center" data-width="380">Detalle</th>
                                    <th data-field="quantity" data-align="center" data-width="50">Cantidad</th>
                                    <th data-field="pvp" data-footer-formatter="footerTable" data-align="center"
                                        data-width="50">Valor Unitario</th>
                                    <th data-field="pvpTotal" data-formatter="totalProducto"
                                        data-footer-formatter="calcularSubtotal" data-align="center" data-width="50">
                                        Valor Total</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row text-right">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-danger" title="Eliminar todo" @click="deleteTable()">
                            Eliminar Venta <i class="fas fa-trash-alt"></i>
                        </button>
                        <button @click="storeSale()" type="button" class="btn btn-success">
                            Guardar Venta <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
window.operateEventsSale = {
    'click .deleteButtonSales':function(e, value,row){
      
        $('#tableSale').bootstrapTable('remove',{
            field:'id',
            values: row.id.toString()
        });
      
    }
}

export default {
    data(){
        return{
            //TODO copié desde aquí
            /*ci:'',
            name: '',
            last_name: '',
            address: '',
            phone: '',
            email: '',
            date: '',
            userExist: false,
            client: '',*/
            //TODO copié hasta aquí
            productList: '',
            inputProduct: '',
            quantity:1,
            payment:false,
            vendedores:[],
            tableactive:false,
            
        }
    },
    mounted(){
        this.init();

        //TODO si funciona pero lo comento porque lo estoy probando por componentes
        /*$(function(){
        $(".validarNumeros").keydown(function(event){
            //alert(event.keyCode);
            if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
                return false;
            }
            });
        });

        $(function(){
            $(".validarLetras").keydown(function(event){
                //alert(event.keyCode);
                if(event.keyCode >= 48 && event.keyCode <= 57){
                    return false;
                }
            });
        });*/

    },
    beforeMount(){
        this.date = moment().format('YYYY-MM-DD');
    },
    methods: {
        //TODO copié desde aquí
        /*checkClient() {
            if (this.ci == '') {
                Swal.fire('El número no se encuentra registrado', '', 'error')
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
        },*/
        //TODO copie hasta aquí
        deleteTable(){
               
            Swal.fire({
                icon: 'error',
                title:'Se borraran todos los datos ingresados',
                text: '¿Está seguro?',
                showCancelButton: true,
                cancelButtonText:'Cancelar',
                confirmButtonText:'Eliminar',
                cancelButtonColor: 'green',
                confirmButtonColor:'red'
                }).then((result)=>{
                if (result.value) {
                    $('#tableSale').bootstrapTable('removeAll');
                 
                    Swal.fire({
                        icon: 'success',
                        text: 'Datos eliminados correctamente',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }  
            });
            this.totalRows()
        },
        init(){
            $('#tableSale').bootstrapTable({
                height:'500'
            });
            this.getSellers();
        },
        storeSale(){
            console.log($('#formSale').serialize())
        },
        refresh(){ 
            $('#tableSale').bootstrapTable('refresh');
        },
        getSellers(){
            axios.get('sellers')
                 .then(({data})=>{
                     this.vendedores = data
                 })
                 .catch((error)=>{
                     console.log(error.response.data)
                 })
        },
        totalRows(){
            this.tableactive = $('#tableSale').bootstrapTable("getOptions").totalRows > 0? true:false;
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
                            cash: product.prices.cash,
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
        addProduct() {
            let productExists = false;
            let product = '';
            let pvp = 0;


            for (let index = 0; index < this.productList.length; index++) {
                let productName = this.productList[index].name + '[' + this.productList[index].code + ']'
                if (productName == this.inputProduct) {
                    productExists = true;
                    product = this.productList[index];
                    break;
                }
            }

            if (productExists) {

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

                $('#tableSale').bootstrapTable('insertRow', {
                    index: $('#tableSale').bootstrapTable('getOptions').totalRows + 1,
                    row: {
                        product: product.name,
                        code: product.code,
                        id: product.id,
                        quantity: this.quantity,
                        acciones: 'x',
                        pvp: pvp,
                        pvpTotal: (this.quantity * pvp).toFixed(2)
                    }

                })

                this.quantity = 1;
                this.inputProduct = ''
                this.totalRows();
                this.$refs.inputProduct.focus()
            }
    },
        totalRows(){
            this.tableactive = $('#tableSale').bootstrapTable("getOptions").totalRows > 0? true:false;
        },
    }
}
</script>

<style>

    #body-form{
        margin: 1rem auto 1rem;
        border: 1px solid rgb(19, 18, 18);
        box-shadow: 3px 3px 3px 3px rgb(123, 190, 157);
        border-radius: 15px;
        padding: 1rem;
    }

    .title-form{
        font-size: 20px;
        text-align: center;
        font-weight: bold;
    }

    .label-container{
        margin-right: -275px;
    }

    .button-container{
        margin-left: -93px;
    }

    hr{
        background: rgb(123, 190, 157);
    }

    .title-form-group{
        font-size: 17px;
        font-weight: bold;
    }

    .vertical-line{
        border-right: 2px solid rgb(123, 190, 157);
    }

    .btn-modify{
        margin-left: -125px;
    }
</style>