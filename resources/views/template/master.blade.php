<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <style link="{{asset('css/style.css')}}"></style> -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    @include('template.header')
<<<<<<< HEAD
    @yield('conteudo-view')    
=======

    @yield('conteudo-view')
    
>>>>>>> eaa3d8b4ca931c3c77288f76b9cd6a488c2ed231
    @include('template.footer')
</body>
</html>