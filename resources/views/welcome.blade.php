<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <script src="https://kit.fontawesome.com/0dc07ae90e.js" crossorigin="anonymous"></script>
        <!-- Boxicons -->
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        @vite('resources/css/app.css')
  
    </head>
    <body >
         <div id="app">

         </div>

          
         @vite('resources/js/app.js')
         @vite('resources/js/script.js')
    </body>

</html>
