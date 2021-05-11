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
    @yield('conteudo-css')
</head>
<body>
    @include('template.header')

    @if(session('success'))
        <div class="alert alert-success m-5">
            {{session('success')['messages']}}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger m-5">
            {{session('error')['messages']}}
        </div>
    @endif

    @yield('conteudo-view')

    @include('template.footer')
</body>
</html>
