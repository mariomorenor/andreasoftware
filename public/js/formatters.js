
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
    
    let total = data.map(function (row) {
      return +row[field]
    }).reduce(function (sum, i) {
        return Number((sum + i).toFixed(2));
        }, 0)

        // TODO cambiar y mejorar el iva
        let total_iva = total * 0.12;
        let subtotal = total - total_iva;

        return Number(subtotal.toFixed(2))+"<br>"+Number(total_iva.toFixed(2))+"<br>"+Number(total.toFixed(2));
}

function footerTable(){
    return "Subtotal: <br> Iva 12%: <br> Total: ";
}

//Bancos

function banksUserFormatter(value, row) {
    return value.name;
}

function banksDateFormatter(value, row) {
    return moment(value).format('LL')+' - '+ row.time.substring(0,5);
}

function banksQuantityFormatter(value) {
    return '<i class="fas fa-dollar-sign"></i> '+value;
}