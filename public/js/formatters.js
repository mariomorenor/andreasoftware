

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