<!DOCTYPE html>
<html lang="eS">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <table class="">
            <thead class="">
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
</body>
</html>