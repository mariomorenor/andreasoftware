

//Inventario
function eventsFormatter(value, row){
    return '<button class="btn btn-success editButtonProduct mr-2"><i class="fas fa-edit"></i></button>'+
            '<button class="btn btn-danger deleteButtonProduct "><i class="fas fa-trash-alt"></i></button>'
}
function stockFormatter(value, row) {
    return row.prices.stock;
}
function costFormatter(value,row) {
    return '<i class="fas fa-dollar-sign"></i> '+row.prices.cost
}
function cashFormatter(value,row) {
    return '<i class="fas fa-dollar-sign"></i> '+row.prices.cash
}
function promoFormatter(value,row) {
    return '<i class="fas fa-dollar-sign"></i> '+row.prices.promo
}
function creditFormatter(value,row) {
    return '<i class="fas fa-dollar-sign"></i> '+row.prices.credit
}

// Clientes
function clientsEventFormatter(value,row) {
    return '<button class="btn btn-success editButtonClient mr-2"><i class="fas fa-edit"></i></button>'+
    '<button class="btn btn-danger deleteButtonClient "><i class="fas fa-trash-alt"></i></button>'
}

//Ventas

function salesAccionesFormatter(value, row) {
    return '<button type="button" class="btn btn-danger deleteButtonSales "><i class="fas fa-trash-alt"></i></button>'
}

function totalProducto(value, row){
    return Number((row.quantity*row.pvp).toFixed(2));
}

function calcularSubtotal(data){
    var field = this.field
    return data.map(function (row) {
      return +row[field]
    }).reduce(function (sum, i) {
        var iva = 12;
        var total = sum + i;
        var subtotal = total / (1 + (iva / 100));
        return Number(subtotal.toFixed(2));
    }, 0)
}

function calcularTotal(data){
    var field = this.field
    return data.map(function (row) {
      return +row[field]
    }).reduce(function (sum, i) {
        return Number((sum + i).toFixed(2));
    }, 0)
}

function calcularIva(data){
    var field = this.field
    return data.map(function (row) {
      return +row[field]
    }).reduce(function (sum, i) {
        alert('hola');
        var iva = 12;
        var total = sum + i;
        var subtotal = suma / (1 + (iva / 100));
        var total_iva = total - subtotal;
        alert ('subtotal: '+ total_iva);
        return Number(total_iva.toFixed(2));
    }, 0)
}

//Bancos

function banksUserFormatter(value, row) {
    return value.name;
}

function banksDateFormatter(value, row) {
    return moment(value).format('LL')+' - '+ row.time;
}

function banksQuantityFormatter(value) {
    return '<i class="fas fa-dollar-sign"></i> '+value;
}