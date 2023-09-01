<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('gentella/production/images/bolu.png') }}" type="image/x-icon">

    <title>@yield('title')</title>

    @include('layouts.includes.css')
    @yield('css')
    
  </head>

  <body class="nav" style="background-color: #f7f7f7 !important;">

    <div class="container body">
      

        @include('layouts.includes.front-navbar')

        
        <div class="right_col" role="main">
            @yield('content')          
        </div>
        

        <!-- @include('layouts.includes.footer') -->

     
    </div>

    @include('layouts.includes.js')
    @yield('js')
  </body>
</html>