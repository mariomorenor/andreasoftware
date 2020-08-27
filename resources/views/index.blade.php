<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Andrea's Software</title>
  </head>
  <body>
    
    <div id="app">
        <app-component></app-component>
    </div>
    <script src="{{ asset('js/formatters.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

 </body>
</html>