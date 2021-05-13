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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
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
