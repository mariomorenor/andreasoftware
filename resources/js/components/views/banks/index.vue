<template>
  <div class="container" id="MainBanks">
      <div id="toolbarTableBank" class="d-flex">
          <div class="form-group d-flex">
              <label for="" class="font-weight-bold my-auto">Desde:</label>
              <input type="date" name="since" v-model="since" :max="until" id="inputSince" class="form-control">
          </div>
          <div class="form-group ml-2 d-flex">
              <label for="until" class="font-weight-bold my-auto">Hasta:</label>
              <input type="date" name="until" class="form-control" :min="since" :max="today" id="inputUntil" v-model="until">
              <button type="button" @click="filterByDate()" class="btn btn-info ml-3" :disabled="since == '' || until == '' ? true:false">Filtrar</button>
          </div>
          <div class="form-group">
              <button class="btn btn-primary ml-3" type="button"  data-toggle="modal" data-backdrop="static" data-target="#modalAddIncome">Agregar Depósito</button>
          </div>
        <form action="/report-download/banks" id="formPDF" class="inline-block" method="get">
            <input type="hidden" name="format" value="PDF">
            <input type="hidden" name='totalPages' :value="totalPages">
            <input type="hidden" name='pageNumber' :value="pageNumber" >
            <input type="hidden" name='pageSize' :value="pageSize" >
            <button type="button" @click="downloadPDF()" class="btn btn-danger ml-5">PDF</button>
        </form>
        <form action="/report-download/banks" class="inline-block" method="get">
        <input type="hidden" name="format" value="EXCEL">
            <button type="submit" class="btn btn-success ml-1">EXCEL</button>
        </form>
      </div>
      <table id="tableBanks" data-toolbar="#toolbarTableBank" data-page-list="[10,25,50,100,all]" data-pagination="true" data-search="true">
          <thead class="thead-dark">
              <tr>
                  <th data-field="date" data-width="300" data-sortable="true" data-align="center" data-formatter="banksDateFormatter">Fecha</th>
                  <th data-field="user" data-sortable="true" data-align="center" data-formatter="banksUserFormatter">Usuario</th>
                  <th data-field="quantity" data-align="center" data-formatter="banksQuantityFormatter">Cantidad</th>
              </tr>
          </thead>
      </table>
        <!-- Modal -->
        <div class="modal fade" id="modalAddIncome" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Depósito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="px-4 col-8 mx-auto">
                            <div class="form-group">
                                <label for="dateNewIncome">Fecha:</label>
                                <input type="date" name="dateNewIncome" v-model="dateNewIncome" :max="dateNewIncome" id="dateNewIncome" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Cantidad $:</label>
                                <input type="number" name="quantityIncome" v-model="quantityIncome" id="quantityIncome" class="validarNumeros form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="timeNewIncome">Hora:</label>
                                <input type="time" name="timeNewIncome" v-model="timeNewIncome" id="timeNewIncome" class="form-control" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success shadow-lg" @click="addIncome()">Agregar</button>
                </div>
                </div>
            </div>
        </div>

  </div>
</template>

<script>
export default {
    data() {
        return {
            since: '',
            until:'',
            quantity:'',
            dateNewIncome:'',
            quantityIncome:0,
            timeNewIncome:'',
            totalPages:'',
            pageNumber:'',
            pageSize:'',
        }
    },
    beforeMount() {
        this.since = moment(moment().date(1)).format('Y-MM-DD');
        this.until = this.today;
        this.dateNewIncome = moment().format('Y-MM-DD');
        this.timeNewIncome = moment().format('LT');
    },
    mounted() {
        this.init()
        this.screenSize();

        $(function(){
        $(".validarNumeros").keydown(function(event){
            if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
                return false;
            }
            });
        });

    },
    methods: {
        screenSize(){
                    if (window.innerWidth<=1366) {
                        $('#tableBanks').bootstrapTable( 'resetView' , {height: 450} );
                    } else if(window.innerWidth>1366 && window.innerWidth<=1920) {
                            $('#tableBanks').bootstrapTable( 'resetView' , {height: 700} );
                    }
        },
        init(){
            let that = this;
            $('#tableBanks').bootstrapTable({
                url:'/incomes',
                sortStable: true,
                queryParams:{
                    since: that.since,
                    until: that.until,
                },
            });
        },
        filterByDate(){
            let that = this;
            $('#tableBanks').bootstrapTable("refreshOptions",{
                url:'/incomes',
                 sortStable: true,
                queryParams:{
                    since: that.since,
                    until: that.until,
                },
                responseHandler:function(res){
                    // console.log(res)
                    return res;
                }
            });
        },
        addIncome(){  
            if (this.quantityIncome <= 0 ) {
                Swal.fire({
                    icon:'error',
                    title: 'Error!',
                    text:'La cantidad no puede ser menor o igual a 0',
                    timer:1500
                })
            } else {
            axios.post('/incomes',{
                    user_id: this.$store.state.user.id,
                    quantity:this.quantityIncome,
                    date: this.dateNewIncome,
                    time: this.timeNewIncome,
            })
            .then((data)=>{
                if (data.status == 200) {
                    this.resetModalNewIncome();
                    $('#tableBanks').bootstrapTable('refresh');
                    Swal.fire({
                        icon:'success',
                        title:'La operación se realizó Correctamente!',
                        timer:1500
                    })
                }
            })
            }
        },
        resetModalNewIncome(){
                    $('#modalAddIncome').modal('hide');
                    this.dateNewIncome = moment().format('Y-MM-DD');
                    this.quantityIncome = 0;
                    this.timeNewIncome = moment().format('LT');
        },
        downloadPDF(){
            this.totalPages = $('#tableBanks').bootstrapTable('getOptions').totalPages,
            this.pageNumber = $('#tableBanks').bootstrapTable('getOptions').pageNumber
            this.pageSize = $('#tableBanks').bootstrapTable('getOptions').pageSize
            setTimeout(function(){
              $('#formPDF')[0].submit(function (e) {});
              
            },500);       
    }
    },
    computed: {
        today(){
            return moment().format('Y-MM-DD');
        },
    },
}
</script>

<style>
.btn-info{
    color: #fff;
background-color: #17a2b8;
border-color: #17a2b8;
}
.btn-info:hover{
background-color: #2a717c;
border-color: #2a717c;
}
@media screen and (min-width: 1367px){
  #MainBanks{
    margin-top: 3rem;
  }
}
</style>