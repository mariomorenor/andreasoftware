<template>
  <div class="container" id="Main">
      <div id="toolbar" class="d-flex">
          <router-link :to="{name:'createClient'}" class="btn btn-primary">Agregar Cliente <i
                  class="fas fa-plus-circle"></i></router-link>
          <form action="/report-download/clients" id="formPDFClients" class="inline-block" method="get">
              <input type="hidden" name="format" value="PDF">
              <input type="hidden" name='totalPages' :value="totalPages">
              <input type="hidden" name='pageNumber' :value="pageNumber">
              <input type="hidden" name='pageSize' :value="pageSize">
              <button type="button" v-on:click="downloadPDFClient()" class="btn btn-danger ml-5">PDF</button>
          </form>
          <form action="/report-download/clients" class="inline-block" method="get">
              <input type="hidden" name="format" value="EXCEL">
              <button type="submit" class="btn btn-success ml-1">EXCEL</button>
          </form>
      </div>
      <table class="table table-stripped table-hover" id="tableClients" data-page-list="[10, 25, 50, 100, 200, All]"
          data-pagination="true" data-page-size="100" data-toolbar="#toolbar" data-search="true">
          <thead class="thead-dark">
              <tr>
                  <th data-field="name" data-sortable="true">Nombres</th>
                  <th data-field="last_name" data-sortable="true">Apellidos</th>
                  <th data-field="cedula">Cédula/Ruc</th>
                  <th data-field="address">Dirección</th>
                  <th data-field="phone">Teléfono</th>
                  <th data-field="email">Correo</th>
                  <th data-formatter="clientsEventFormatter" data-field="acciones" data-events="operateEvents"
                      data-width="120"></th>
              </tr>
          </thead>
      </table>
  </div>
</template>

<script>
window.operateEvents = {
  'click .editButtonClient':function(e,value,row){
    app.__vue__.$router.push({name:'editClient', params:{client:row}})
  },
  'click .deleteButtonClient':function(e, value,row){
    Swal.fire({
      icon: 'error',
      title:'¿Seguro de Eliminar este cliente?',
      showCancelButton: true,
      cancelButtonText:'Cancelar',
      confirmButtonText:'Eliminar',
      cancelButtonColor: 'green',
      confirmButtonColor:'red'
    }).then((result)=>{
      if (result.value) {
        axios.delete('/clients/'+row.id)
              .then((response)=>{
                if (response.status == 200) {
                  $('#tableClients').bootstrapTable('remove',{
                  field:'name',
                  values: row.name
                  });
                }
                Swal.fire({
                  icon:'success',
                  title:'Cliente Eliminado Correctamente',
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
    mounted() {
        this.init()
        this.screenSize()
    },
    data() {
      return {
        totalPages:'',
        pageNumber:'',
        pageSize:''
      }
    },
methods: {
    init(){
        $('#tableClients').bootstrapTable({
            url:'/clients'
        });
    },
    screenSize(){
                    if (window.innerWidth<=1366) {
                        $('#tableClients').bootstrapTable( 'resetView' , {height: 500} );
                    } else if(window.innerWidth>1366 && window.innerWidth<=1920) {
                            $('#tableClients').bootstrapTable( 'resetView' , {height: 700} );
                    }
    },
    downloadPDFClient(){
            this.totalPages = $('#tableClients').bootstrapTable('getOptions').totalPages,
            this.pageNumber = $('#tableClients').bootstrapTable('getOptions').pageNumber
            this.pageSize = $('#tableClients').bootstrapTable('getOptions').pageSize
            setTimeout(function(){
              $('#formPDFClients')[0].submit(function (e) {});
            },1000);      
    },
    
    
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