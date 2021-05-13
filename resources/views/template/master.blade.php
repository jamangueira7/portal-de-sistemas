<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Sistemas</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <!-- <style link="{{asset('css/style.css')}}"></style> -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/megamenu.css') }}">
  
    <!-- fontes -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    @yield('conteudo-css')
</head>
<body>
    @include('template.header')

    @if(session('success'))
        <!-- <div class="alert alert-success m-5">
            {{session('success')['messages']}}
        </div> -->
    @elseif(session('error'))
        <div class="alert alert-danger m-5">
            {{session('error')['messages']}}
        </div>
    @endif

    @yield('conteudo-view')

    @include('template.footer')
</body>
</html>
