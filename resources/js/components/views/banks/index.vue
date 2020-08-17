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
              <button type="button" @click="filterByDate()" class="btn btn-success ml-3" :disabled="since == '' || until == '' ? true:false">Filtrar</button>
          </div>
          <div class="form-group">
              <button class="btn btn-primary" type="button">Agregar Depósito</button>
          </div>
      </div>
      <table id="tableBanks" data-toolbar="#toolbarTableBank" data-pagination="true" data-search="true">
          <thead class="thead-dark">
              <tr>
                  <th data-field="date" data-width="300" data-sortable="true" data-align="center" data-formatter="banksDateFormatter">Fecha</th>
                  <th data-field="user" data-sortable="true" data-align="center" data-formatter="banksUserFormatter">Usuario</th>
                  <th data-field="quantity" data-align="center" data-formatter="banksQuantityFormatter">Cantidad</th>
              </tr>
          </thead>
      </table>
  </div>
</template>

<script>
export default {
    data() {
        return {
            since: '',
            until:'',
            quantity:''
        }
    },
    beforeMount() {
        this.since = moment(moment().date(1)).format('Y-MM-DD');
        this.until = this.today;
    },
    mounted() {
        this.init()
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
            let that = this;
            
            axios.post('/incomes',{
                    user_id: that.$store.state.user.id,
                    quantity:3,
                    date: moment().format("YYYY-MM-DD"),
                    time: moment().format("hh:mm:ss"),
                
            })
            .then(({data})=>{
                console.log(data)
            })
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
@media screen and (min-width: 1367px){
  #MainBanks{
    margin-top: 3rem;
  }
}
</style>