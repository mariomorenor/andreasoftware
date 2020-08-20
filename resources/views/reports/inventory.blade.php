<!DOCTYPE html>
<html lang="eS">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
</head>
<body>
    <div class="container">
        <table class="">
            <thead class="">
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
                    <td>{{$product->prices->cost}}</td>
                    <td>{{$product->prices->cash}}</td>
                    <td>{{$product->prices->promo}}</td>
                    <td>{{$product->prices->credit}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        body{
           hola 
        }
    </style>
</body>
</html>