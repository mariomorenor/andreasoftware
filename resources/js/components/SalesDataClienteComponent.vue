<template>
  <div>
      <p class="title-form-group">Cliente</p>
      <div class="row">
          <div class="col-md-4 label-container">
              <label for="cedula" class="font-weight-bold">Cédula/RUC: </label>
          </div>
          <div class="col-md-4">
              <input type="text" name="cedula" id="cedula" class="form-control" style="width: 73%" v-model="ci"
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
              <input type="text" name="name" id="name" class="form-control" v-model="name" :readonly="userExist"
                  autocomplete="off" required>
          </div>
          <div class="col-md-1">
              <label for="last-name" class="font-weight-bold">Apellidos: </label>
          </div>
          <div class="col-md-3">
              <input type="text" name="last_name" id="last_name" class="form-control" v-model="last_name"
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
              <input type="text" name="phone" id="phone" class="form-control" v-model="phone" :readonly="userExist"
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
      </div>
  </div>
</template>

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
        }
    },
    //=---- 
methods: {
        checkClient() {
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
        },

},
// -----

}
</script>

<style>

</style>