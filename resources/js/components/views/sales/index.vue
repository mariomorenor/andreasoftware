<template>
    <div class="container" id="formulario">
        <div class="container" id="body-form">
            <p class="title-form">Facturación</p>
            <form id="formSale" action="#">
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
                <dataclient-component></dataclient-component>
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
                                <input type="number" class="form-control" v-on:keyup.enter="addProduct()" min="1"
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
            productList: '',
            inputProduct: '',
            quantity:1,
            payment:false,
            vendedores:[],
            tableactive:false,
            
        }
    },
    mounted(){
        this.init()
    },
    beforeMount(){
        this.date = moment().format('YYYY-MM-DD');
    },
    methods: {
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
