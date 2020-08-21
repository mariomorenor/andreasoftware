<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Inventario</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
</head>
<body>

    <div class="row header1">
        <div class="logo-report text-center" >
          @isset ($isPDF)
            <img src="{{ asset('img/app/imgLogo.jpeg') }}">
          @endisset
        </div>
      
        <div class="business">
          <p>
            <strong>Distribuidora de Productos Naturales "Voluntad de Dios"</strong><br>
            Santo Domingo - Ecuador
          </p>
        </div>
      
        <div class="info">
          <p>
            Sitio web: <a href="#">Sitio web de la empresa</a><br>
            E-mail: <a href="#">Correo de la empresa</a><br>
            Teléfono: 0997987614<br>
          </p>
        </div>
    </div>
    
    <div class="container">

        <h2>Reporte de Inventario</h2>
        
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
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    <script type="text/php">

        if (isset($pdf)) {
            $x = 470;
            $y = 800;
            $text = "Página {PAGE_NUM} de {PAGE_COUNT}";
            $font = null;
            $size = 10;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }

        if (isset($pdf)) {
            $x = 70;
            $y = 800;
            $text = "Obtenido el: ".date('d-m-Y H:i:s');
            $font = null;
            $size = 10;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script> 

    <style>

        .header1{
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
        
        .logo-report,.business,.info{
            vertical-align: top;
            display: inline-block;
            font-size: 1rem;
            padding: 0 1rem;
            min-height: 1px
        }

        .info{
            margin-left: 5%;
        }

        img{
            width: 15%;
            height: 15%;
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
            margin-top: 2%;
        }

        tr > td, tr > th{
            border: 1rem solid rgb(19, 18, 18);
            border-collapse: collapse;
            margin: 8px;
            padding: 8px;
            font-size: 15px;
        }

        tr > th{
            background-color: rgb(123, 190, 157);
        }
    </style>
    
</body>
</html>