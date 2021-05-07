@extends('template.admin.master')
@section('conteudo-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <option value="{{$item->page->id}}" selected>{{$item->page->description}}</option>
                    @foreach($pages as $page_item)
                        <option value="{{$page_item->id}}">{{$page_item->description}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="father">Escolha um pai para esse item:</label>
                <select class="custom-select" name="father" id="father">
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

            <div id="grupos_change">
                @include('suport.selectListGroups', [
                'model' => $page->groups,
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
    <script type="text/javascript">
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#page").change(function() {

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


            });
        });
    </script>
@stop

