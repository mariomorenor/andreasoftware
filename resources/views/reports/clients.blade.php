<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Clientes</title>
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

        <h2>Reporte de Clientes</h1>

        <table class="clients-report">
            <thead class="head-report">
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Cédula</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                </tr>
            </thead>
            @foreach ($clients as $client)
                <tr>
                    <td>{{$client->name}}</td>
                    <td>{{$client->last_name}}</td>
                    <td>{{$client->cedula}}</td>
                    <td>{{$client->address}}</td>
                    <td>{{$client->phone}}</td>
                    <td>{{$client->email}}</td>
                </tr>
            @endforeach
        </table>
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