@extends('template.admin.master')
@section('conteudo-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="https://cdnpub.tokiomarine.com.br/portal_static/publico/padrao/3.3.4/addons/chosen-master/css/chosen.css">
@endsection
@section('conteudo-view')

    <div class="container col-md-10">

        <h2 class="mb-5">Alterar Item de menu</h2>
        <form method="POST" action="{{route('admin.items.update', [$item->id])}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Titulo:</label>
                <input value="{{$item->title}}" type="text" class="form-control" name="title" id="title" placeholder="Titulo">
            </div>
            <div class="form-group">
                <label for="url">URL:</label>
                <input value="{{$item->url}}" type="text" class="form-control" name="url" id="url" placeholder="URL">
            </div>

            <div class="form-group">
                <label for="page">Pagina:</label>
                <select class="custom-select" name="page" id="page">
                    <option value="{{$item->page->id ?? ''}}" selected>{{$item->page->description ?? ''}}</option>
                    @foreach($pages as $page_item)
                        <option value="{{$page_item->id}}">{{$page_item->description}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="items_change">
                <label for="father">Escolha um pai para esse item:</label>
                <select data-placeholder="Escolha um pai para esse item" class="form-control chosen-select" name="father" id="father">
                    <option value="-1" selected>Sem pai</option>

                @foreach($items as $val)
                        @if($val->id === $item->father)
                            <option value="{{$val->id}}" selected>{{$val->title}}</option>
                        @elseif($val->id === $item->id)

                        @else
                            <option value="{{$val->id}}">{{$val->title}}</option>
                        @endif

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="users">Escolha um responsável:</label>
                <select name="users[]" id="users" data-placeholder="Escolha um responsável" class="form-control chosen-select" multiple>
                    @foreach($users as $user)
                        <option {{in_array($user->id, $item_users) ? 'selected' : ''}}
                                value="{{$user->id}}"
                        >{{$user->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" {{$item->new_tab ? 'checked' : ''}} class="form-check-input" id="new_tab" name="new_tab">
                <label class="form-check-label" for="new_tab" >Abrir em nova aba</label>
            </div>

            <div id="grupos_change">
                @include('suport.selectListGroups', [
                'model' => $page->groups ?? [],
                'model_groups' => $item_groups,
                'label' => 'Grupos da página escolhida:',
            ])
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Alterar</button>
            </div>
        </form>
    </div>
@stop
@section('js-view')
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
    <script src="https://cdnpub.tokiomarine.com.br/portal_static/publico/padrao/3.3.4/addons/chosen-master/js/chosen.jquery.js"></script>

    <script type="text/javascript">

        $(".chosen-select").chosen();

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#page").change(function() {
                buscarGroups();
                buscarItens();
            });

            function buscarGroups() {
                var url = "{{ route('admin.ajax.groups.page') }}";

                $.ajax({
                    type:'POST',
                    url: url,
                    data:{ codigo:  $("#page").val()},

                    success:function(data){

                        var html = '<label for="groups">Grupos da página escolhida:</label><div class="form-group row">';

                        for (var i = 0, l = data['grupos'].length; i < l; i++) {
                            html += '<div class="form-check col-4"><input class="form-check-input" type="checkbox"id="check-'+data['grupos'][i].id+'" name="groups[]" value="'+data['grupos'][i].id+'" "checked"> <label class="form-check-label" for="check-'+data['grupos'][i].id+'">'+data['grupos'][i].description+'</label></div>';
                        }
                        html += '</div>';
                        $("#grupos_change").html(html);

                    },

                    error:function(data){
                        console.log('Erro no Ajax!');
                    },

                });
            }

            function buscarItens() {
                var url = "{{ route('admin.ajax.groups.items') }}";

                $.ajax({
                    type:'POST',
                    url: url,
                    data:{ codigo:  $("#page").val()},

                    success:function(data){

                        var html = '<label for="groups">Escolha um pai para esse item:</label>';
                        html += '<select name="father" id="father" data-placeholder="Escolha um pai para esse item" class="form-control chosen-select">';
                        html += '<option value="-1" selected>Sem pai</option>';
                        for (var i = 0, l = data['items'].length; i < l; i++) {
                            html += '<option value="'+ data['items'][i].id +'">'+ data['items'][i].title +'</option>';
                        }
                        html += '</select>';
                        $("#items_change").html(html);
                        $(".chosen-select").chosen();

                    },

                    error:function(data){
                        console.log('Erro no Ajax!');
                    },

                });
            }
        });
    </script>
@stop

