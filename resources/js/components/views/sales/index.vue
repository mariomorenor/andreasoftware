<template>
<<<<<<< HEAD

<div>


  <div class="row section">

	<div class="col-2">
    <h1 contenteditable>Factura</h1>
  </div><!--.col-->

  <div class="col-2 text-right details">
    <p contenteditable>
      Fecha: <input type="text" class="datePicker" /><br>
      Factura #: <input type="text" value="100" /><br>
     Vence: <input class="twoweeks" type="text"/>
    </p>
  </div><!--.col-->
  
  
  
  <div class="col-2">
    

    <p contenteditable class="client">
      <strong>Facturar a</strong><br>
      [Nombre cliente]<br>
      [Nombre emmpresa]<br>
	    [Dirección empresa]<br>
	    [Tel empresa]
    </p>
  </div><!--.col-->
  
  
  <div class="col-2">
   

    <p contenteditable class="client">
      <strong>Enviar a</strong><br>
      [Nombre cliente]<br>
      [Nombre emmpresa]<br>
	  [Dirección empresa]<br>
	  [Tel empresa]
    </p>
  </div><!--.col-->

  

</div><!--.row-->

<div class="row section" style="margin-top:-1rem">
<div class="col-1">
	<table style='width:100%'>
    <thead contenteditable>
	<tr class="invoice_detail">
      <th width="25%" style="text-align:center">Vendedor</th>
       <th width="25%">Orden de compra </th>
      <th width="20%">Enviar por</th>
      <th width="30%">Términos y condiciones</th>
	 </tr> 
    </thead>
    <tbody contenteditable>
	<tr class="invoice_detail">
      <td width="25%" style="text-align: center">John Doe</td>
       <td width="25%">#PO-2020 </td>
      <td width="20%">DHL</td>
      <td width="30%">Pago al contado</td>
	 </tr>
	</tbody>
	</table>
</div>

</div><!--.row-->

<div class="invoicelist-body">
  <table>
    <thead contenteditable>
      <th width="5%">Código</th>
      <th width="60%">Descripción</th>
      
      <th width="10%">Cant.</th>
      <th width="15%">Precio</th>
      <!-- <th class="taxrelated">IVA</th> -->
      <th width="10%">Total</th>
    </thead>
    <tbody>
      <tr>
        <td width='5%'><a class="control removeRow" href="#">x</a> <span contenteditable>12345</span></td>
        <td width='60%'><span contenteditable>Descripción</span></td>
        <td class="amount"><input type="text" value="1"/></td>
        <td class="rate"><input type="text" value="99" /></td>
        <!-- <td class="tax taxrelated"></td> -->
        <td class="sum"></td>
      </tr>
    </tbody>
  </table>
  <a class="control newRow" href="#">+ Nueva fila</a>
</div><!--.invoice-body-->

<div class="invoicelist-footer">
  <table contenteditable>
    <tr class="taxrelated">
      <td>IVA:</td>
      <td id="total_tax"></td>
    </tr>
    <tr>
      <td><strong>Total:</strong></td>
      <td id="total_price"></td>
    </tr>
  </table>
</div>

<div class="note" contenteditable>
  <h2>Nota:</h2>
</div><!--.note-->

<footer class="row">
  <div class="col-1 text-center">
    <p class="notaxrelated" contenteditable>El monto de la factura no incluye el impuesto sobre las ventas.</p>
    
=======
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