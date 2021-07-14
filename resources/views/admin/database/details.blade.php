@extends('template.admin.master')
@section('conteudo-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="https://cdnpub.tokiomarine.com.br/portal_static/publico/padrao/3.3.4/addons/chosen-master/css/chosen.css">
@endsection
@section('conteudo-view')

    <div class="container col-md-10">

        <h2 class="mb-5">Administração do banco de dados</h2>

        @if($data)
            <table class="table table-striped" id="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Backup</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item}}</td>
                        <td>
                            <a href="{{route('admin.database.use', [$item])}}" type="button" class="btn btn-outline-warning">Usar</a>
                            <a href="{{route('admin.database.download', [$item])}}" type="button" class="btn btn-outline-info">Baixar</a>

                            <button onclick="deleteRegister('{{$item}}')" type="button" class="btn btn-outline-danger">Deletar</button>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h3>Sem dados.</h3>
        @endif
        <fieldset class="border-1 border-dark">
            <legend>Ações:</legend>
            <a href="{{route('admin.database.generate')}}" type="button" class="btn btn-primary btn-lg btn-block">Gerar backup</a>
        </fieldset>

    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-white" id="myModalLabel">Realmente deseja excluir esse registro?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-outline-danger" id="modal-btn-yes" style="width:150px">Sim</button>
                    <button type="button" class="btn btn-lg btn-outline-primary" id="modal-btn-not" style="width:150px">Não</button>
                </div>
            </div>
        </div>
    </div>

@stop
@section('js-view')

    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>

    <script type="text/javascript">

        let idDeelte = '';
        function deleteRegister(id) {
            idDeelte = id;
            jQuery.noConflict();
            $("#mi-modal").modal('show');
        }

        var modalConfirm = function(callback){

            $("#modal-btn-yes").on("click", function(){
                callback(true);
                $("#mi-modal").modal('hide');
            });

            $("#modal-btn-not").on("click", function(){
                callback(false);
                $("#mi-modal").modal('hide');
            });
        };

        modalConfirm(function(confirm){
            if(confirm){
                window.location = '/admin/database/delete/'+idDeelte;
            }else{
                return;
            }
        });

        $(document).ready(function () {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@stop

