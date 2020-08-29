<template>

    <div class="container" id="formulario">

        <div class="container" id="body-form">
            <p class="title-form">Facturación</p>

            <form action="#">

                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right">
                            <label for="vendedor" class="font-weight-bold">Vendedor: </label>
                            {{this.$store.state.user.name}}
                        </div>
                    </div>
                </div><hr>

                <p class="title-form-group">Cliente</p>
                <div class="row">
                    
                    <div class="col-md-4 label-container">
                        <label for="cedula" class="font-weight-bold">Cédula/RUC: </label>
                    </div>
                        
                    <div class="col-md-4">
                        <input type="text" name="cedula" id="cedula" class="form-control" v-model="ci" autocomplete="off" required>
                    </div>

                    <div class="col-md-4">
                        <button type="button" class="btn btn-outline-success" @click="checkClient()" title="Confirmar cédula">
                            <i class="fas fa-check-circle"></i>
                        </button>

                        <div v-show="userExist">
                            <router-link class="btn btn-outline-primary" title="Modificar Usuario" :to="{name:'editClient', params:{client}}">
                                <i class="fas fa-edit"></i>
                            </router-link>
                        </div>

                    </div>
                </div><br>

                <div class="row">

                    <div class="col-md-1">
                        <label for="name" class="font-weight-bold">Nombres: </label>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="name" id="name" class="form-control" v-model="name" :readonly="userExist" autocomplete="off" required>
                    </div>

                    <div class="col-md-1">
                        <label for="last-name" class="font-weight-bold">Apellidos: </label>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="last_name" id="last_name" class="form-control" v-model="last_name" :readonly="userExist" autocomplete="off" required>
                    </div>

                    <div class="col-md-1">
                        <label for="address" class="font-weight-bold">Dirección: </label>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="address" id="address" class="form-control" v-model="address" :readonly="userExist" autocomplete="off" required>
                    </div>
                </div><br>

                <div class="row">

                    <div class="col-md-1">
                        <label for="phone" class="font-weight-bold">Teléfono: </label>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="phone" id="phone" class="form-control" v-model="phone" :readonly="userExist" autocomplete="off" required>
                    </div>

                    <div class="col-md-1">
                        <label for="email" class="font-weight-bold">E-mail: </label>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="email" id="email" class="form-control" v-model="email" :readonly="userExist" autocomplete="off" required>
                    </div>

                    <div class="col-md-1">
                        <label for="date" class="font-weight-bold">Fecha: </label>
                    </div>

                    <div class="col-md-3">
                        <input type="date" name="date" id="date" class="form-control" v-model="date" required>
                    </div>
                </div><hr>

                <div class="row">

                    <div class="col-md-6 vertical-line">
                        <p class="title-form-group">Venta</p>
                        <div class="row">
                            <div class="col-md-auto">
                                <label for="pagos" class="font-weight-bold">Formas de pago: </label>
                            </div>

                            <div class="col-md-auto">
                                <label for="cash">Efectivo</label>
                                <input type="radio" name="payment_type" id="cash" value="cash" v-model="payment" :disabled="tableActive" required>
                            </div>

                            <div class="col-md-auto">
                                <label for="promo">Promoción</label>
                                <input type="radio" name="payment_type" id="promo" value="promo" v-model="payment" :disabled="tableActive" required>
                            </div>

                            <div class="col-md-auto">
                                <label for="credit">Crédito</label>
                                <input type="radio" name="payment_type" id="credit" value="credit" v-model="payment" :disabled="tableActive" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <p class="title-form-group">Productos</p>

                        <div class="row">
                            <div class="col-md-2">
                                <button type="button" class="btn btn-secondary" @click="addProduct()">Agregar</button>
                            </div>

                            <div class="col-md-3">
                                <input type="text" class="form-control" @keyup="getProduct()" v-on:keyup.enter="addProduct()" v-model="inputProduct" list="productList" ref="inputProduct" :disabled="!payment" :title="!payment?'Seleccione un Método de pago':''" autocomplete="off">
                            </div>

                            <div class="col-md-3">
                                <label for="cantidad" class="font-weight-bold">Cantidad: </label>
                            </div>

                            <div class="col-md-2">
                                <input type="number"  class="form-control" v-on:keyup.enter="addProduct()" min="1" step="1" v-model="quantity" :disabled="!payment" required>
                                <datalist id="productList">
                                    <option v-for="(product) in productList" :value="product.name" :key="product.id">{{product.name}}</option>
                                </datalist>
                            </div>

                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger" title="Eliminar todo" @click="deleteTable()">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>


    </div>

</template>

<script>
export default {
    
}
</script>


<style>

    #body-form{
        margin: 1rem auto 0;
        border: 1px solid rgb(19, 18, 18);
        box-shadow: 3px 3px 3px 3px rgb(123, 190, 157);
        border-radius: 15px;
    }

    .title-form{
        font-size: 20px;
        text-align: center;
        font-weight: bold;
    }

    .label-container{
        margin-right: -250px;
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


</style>