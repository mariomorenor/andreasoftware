<template>
  <div class="container" id="Main">
    <div id="toolbar" class="d-flex">
      <router-link :to="{name:'createProduct'}" class="btn btn-primary">Agregar Producto <i class="fas fa-plus-circle"></i></router-link>
      <form action="/report-download/inventory" id="formPDF" class="inline-block" method="get">
        <input type="hidden" name="format" value="PDF">
        <input type="hidden" name='totalPages' :value="totalPages">
        <input type="hidden" name='pageNumber' :value="pageNumber" >
        <input type="hidden" name='pageSize' :value="pageSize" >
        <button type="button" @click="downloadPDF()" class="btn btn-danger ml-5">PDF</button>
      </form>
      <form action="/report-download/inventory" class="inline-block" method="get">
      <input type="hidden" name="format" value="EXCEL">
        <button type="submit" class="btn btn-success ml-1">EXCEL</button>
      </form>
    </div>
      <table data-page-list="[10, 25, 50, 100, 200, All]" data-pagination="true" data-page-size="100" data-toolbar="#toolbar" data-sortable="true" data-search="true"  id="tableInventario" class="table table-hover table-striped">
        <thead class="thead-dark headtable">
          <tr class="text-center">
            <th data-field="code" data-sortable="true" >Código</th>
            <th data-field="product" data-sortable="true" >Producto</th>
            <th data-field="stock" data-formatter="stockFormatter" data-align="center" >Stock</th>
            <th data-field="cost"  data-formatter="costFormatter" data-align="center" >Costo</th>
            <th data-field="cash" data-formatter="cashFormatter"   data-align="center">Efectivo</th>
            <th data-field="promo"  data-formatter="promoFormatter" data-align="center">Promoción</th>
            <th data-field="credit" data-formatter="creditFormatter" data-align="center">Crédito</th>
            <th data-field="events"   data-formatter="eventsFormatter" data-events="operateEventsProduct" data-width="130"></th>

          </tr>
        </thead>
      </table>
  </div>
</template>


<script>
window.operateEventsProduct = {
  'click .editButtonProduct':function(e,value,row){
    app.__vue__.$router.push({name:'editProduct', params:{producto:row}})
  },
  'click .deleteButtonProduct':function(e, value,row){
    Swal.fire({
      icon: 'error',
      title:'¿Seguro de Eliminar este producto?',
      showCancelButton: true,
      cancelButtonText:'Cancelar',
      confirmButtonText:'Eliminar',
      cancelButtonColor: 'green',
      confirmButtonColor:'red'
    }).then((result)=>{
      if (result.value) {
        axios.delete('/products/'+row.id)
              .then((response)=>{
                if (response.status == 200) {
                  $('#tableInventario').bootstrapTable('remove',{
                  field:'code',
                  values: row.code.toString()
                  });
                }
                Swal.fire({
                  icon:'success',
                  title:'Producto Eliminado Correctamente',
                  timer:2000
                })
              })
              .catch((error)=>{
                console.log(error)
              });

      }
    });
  }
}
export default {
  data() {
    return {
      totalPages:'',
      pageNumber:'',
      pageSize:'',
    }
  },
mounted() {
  this.getProducts();
  this.screenSize();

},
methods: {
    screenSize(){
      if (window.innerWidth<=1366) {
          $('#tableInventario').bootstrapTable( 'resetView' , {height: 450} );
      } else if(window.innerWidth>1366 && window.innerWidth<=1920) {
            $('#tableInventario').bootstrapTable( 'resetView' , {height: 700} );
      }
    },
    getProducts(){
       
      $('#tableInventario').bootstrapTable({
        url:'/products',
        responseHandler:function(response){
          // console.log(response.rows)
          return response
        }
      });
    },
    downloadPDF(){
            this.totalPages = $('#tableInventario').bootstrapTable('getOptions').totalPages,
            this.pageNumber = $('#tableInventario').bootstrapTable('getOptions').pageNumber
            this.pageSize = $('#tableInventario').bootstrapTable('getOptions').pageSize
            setTimeout(function(){
              $('#formPDF')[0].submit(function (e) {});
              
            },1000);
            
    }
},
}
</script>

<style>


@media screen and (min-width: 1367px){
  #Main{
    margin-top: 3rem;
  }
}

</style>