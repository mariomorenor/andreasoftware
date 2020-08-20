<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Inventario</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
</head>
<body>

    <header class="row">
        <div class="logo-report text-center" >
          <img src="{{ asset('img/app/imgLogo.jpeg') }}">
        </div>
      
        <div class="business">
          <p>
            <strong>Distribuidora de Productos Naturales "Voluntad de Dios"</strong><br>
            Dirección de la empresa
          </p>
        </div><!--.me-->
      
        <div class="info">
          <p>
            Sitio web: <a href="#">Sitio web de la empresa</a><br>
            E-mail: <a href="#">Correo de la empresa</a><br>
            Teléfono: Telefóno de la empresa<br>
          </p>
        </div>

        <div class="social">
            <p>
              Facebook: <br>
              Instagram: <br>
              Twitter: <br>
            </p>
        </div>
      
    </header>
    
    <div class="container">

        <h2>Reporte de Inventario</h1>

        <table class="inventory-report">
            <thead class="head-report">
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Stock</th>
                    <th>Costo</th>
                    <th>Efectivo</th>
                    <th>Promoción</th>
                    <th>Crédito</th>
                </tr>
            </thead>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->code}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->prices->stock}}</td>
                    <td>$ {{$product->prices->cost}}</td>
                    <td>$ {{$product->prices->cash}}</td>
                    <td>$ {{$product->prices->promo}}</td>
                    <td>$ {{$product->prices->credit}}</td>
                </tr>
            @endforeach
        </table>

        <footer>
            mirar: <?php  ?>
        </footer>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    <style>

        header{
            margin: 0;
            padding: 0;
            border-bottom: 1pt solid rgb(123, 190, 157);
        }

        p{
            font-size: 10px;
        }

        .row{
            position: relative;
            display: block;
            width: 100%;
            font-size: 0
        }
        
        .logo-report,.business,.info,.social,{
            vertical-align: top;
            display: inline-block;
            font-size: 1rem;
            padding: 0 1rem;
            min-height: 1px
        }

        img{
            width: 10%;
            height: 10%;
        }

        h2{
            text-align: center;
        }

        .inventory-report{
            text-align: center;
            margin: auto;
        }

        table{
            border-collapse: collapse;
        }

        tr > td, tr > th{
            border: 1rem solid rgb(19, 18, 18);
            border-collapse: collapse;
            width: 100%;
            margin: 12px;
            padding: 12px;
        }

        tr > th{
            background-color: rgb(123, 190, 157);
        }
    </style>
</body>
</html>