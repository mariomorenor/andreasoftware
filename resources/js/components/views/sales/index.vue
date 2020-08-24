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
                        <div class="invalid-feedback">
                            Ingrese un número de cédula
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
                            <button type="button" class="btn btn-secondary" >Agregar</button>
                            <input type="number" :disabled="!payment">
                            <label for="cantidad" class="label-form">Cantidad: </label>
                            <button type="button" class="btn btn-danger" title="Vaciar tabla"><i class="fas fa-trash-alt"></i></button>
                        </div>                        
                    </div>
                    <hr>
                    
                </div>                
            </div>
        </form>
    </div>
>>>>>>> formulario
  </div>
</template>

<script>
export default {};

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

</style> 