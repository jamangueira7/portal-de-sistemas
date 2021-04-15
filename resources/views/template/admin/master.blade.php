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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    </head>
    <body>
    @include('template.admin.header')
    <div class="container-fluid bg-white"
         style="height: 100%; overflow-y: hidden;"
    >
        <div class="row" style="height: 100% !important; overflow-y: hidden;">
            @include('template.admin.nav')

            <div class="container col-md-10 mt-5 pt-5">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')['messages']}}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')['messages']}}
                    </div>
                @endif
                @yield('conteudo-view')'
            </div>

        </div>
    </div>
    @include('template.admin.footer')


        <script src="{{ asset('js/diversos.js') }}"></script>
        <script src="{{ asset('js/ajax-3-5-1.js') }}"></script>

        <script src="{{ asset('js/jquery-3-3-1.js') }}"></script>
        <script src="{{ asset('js/popper.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    </body>
</html>
