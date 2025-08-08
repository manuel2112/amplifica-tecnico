<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="developer" content="www.cesarcancino.com" />
    <meta name="designer" content="www.cesarcancino.com" />
    <link rel="icon" type="image/x-icon" href="{{asset('img/logo.svg')}}" />
    <title>Laravel 11 - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    @stack('css')
  </head>
  <body>
    <!--contenido-->
 @yield('content')
<!--/contenido-->
<script src="{{asset('js/app.js')}}"></script> 
@stack('scripts')
  </body>
</html>