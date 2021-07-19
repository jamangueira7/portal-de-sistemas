@extends('template.admin.master')
@section('conteudo-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="https://cdnpub.tokiomarine.com.br/portal_static/publico/padrao/3.3.4/addons/chosen-master/css/chosen.css">
@endsection
@section('conteudo-view')

    <div class="container col-md-10" style="height:99%;overflow-y: auto">

        <h2 class="mb-5">Administração do banco de dados</h2>

        <div class="alert-warning" style="padding: 10px; border-radius: 10px;">
            <span>Instruções:</span>
            <ul>
                <li>Antes de usar qualquer função faça um backup do banco.</li>
                <li>A lista de backup aparecerão apenas o ultimos 5 backups por data.</li>
                <li>Antes de usar um backup o ideal é apagar o banco para evitar que os grupos fiquem duplicados.</li>
                <li>Após apagar o banco você será deslogado. Faça o login e apague os grupos. Depois use o backup.</li>
            </ul>
        </div>

        <br>

        @if($data)
            <table class="table table-striped" id="table">
                <thead class="thead-dark">
                <tr class="d-flex">
                    <th scope="col" class="col-6">Backup</th>
                    <th scope="col" class="col-6">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr class="d-flex">
                        <td class="col-6">{{$item}}</td>
                        <td class="col-6">
                            <button onclick="useFile('{{$item}}')" type="button" class="btn btn-outline-warning">Usar</button>
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
        <br>
        <form method="POST" action="{{route('admin.database.create')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="archive">Carregar arquivo</label>
                <input type="file" class="form-control-file" id="archiveT" name="archive">
            </div>
            <button type="submit" id="test" class="btn btn-primary">Enviar arquivo</button>
        </form>
        <br>
        <br>

        <fieldset class="border-1 border-dark">
            <legend>Ações:</legend>
            <a href="{{route('admin.database.generate')}}" type="button" class="btn btn-primary btn-lg btn-block">Gerar backup</a>
            <button onclick="reset()" type="button" class="btn btn-danger btn-lg btn-block">Apagar banco</button>
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

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="use-file">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-white">Realmente deseja usar esse arquivo para gravar alterações no banco?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-outline-danger" id="modal-btn-yes-file" style="width:150px">Sim</button>
                    <button type="button" class="btn btn-lg btn-outline-primary" id="modal-btn-not-file" style="width:150px">Não</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="reset">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-white">Realmente deseja apagar o banco? Gere um backup antes para garantir que os dados não serão perdidos.</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-outline-danger" id="modal-btn-yes-reset" style="width:150px">Sim</button>
                    <button type="button" class="btn btn-lg btn-outline-primary" id="modal-btn-not-reset" style="width:150px">Não</button>
                </div>
            </div>
        </div>
    </div>

@stop
@section('js-view')

    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>

    <script type="text/javascript">

        let idDeelte = '';
        let fileName = '';

        function deleteRegister(id) {
            idDeelte = id;
            jQuery.noConflict();
            $("#mi-modal").modal('show');
        }

        function useFile(name) {
            fileName = name;
            jQuery.noConflict();
            $("#use-file").modal('show');
        }

        function reset() {
            jQuery.noConflict();
            $("#reset").modal('show');
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

        var modalConfirmUseFile = function(callback){

            $("#modal-btn-yes-file").on("click", function(){
                callback(true);
                $("#use-file").modal('hide');
            });

            $("#modal-btn-not-file").on("click", function(){
                callback(false);
                $("#use-file").modal('hide');
            });
        };

        var modalConfirmReset = function(callback){

            $("#modal-btn-yes-reset").on("click", function(){
                callback(true);
                $("#reset").modal('hide');
            });

            $("#modal-btn-not-reset").on("click", function(){
                callback(false);
                $("#reset").modal('hide');
            });
        };

        modalConfirmUseFile(function(confirm){

            if(confirm){
                window.location = '/admin/database/use/'+fileName;
            }else{
                return;
            }
        });

        modalConfirmReset(function(confirm){

            if(confirm){
                window.location = '/admin/database/reset';
            }else{
                return;
            }
        });

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

