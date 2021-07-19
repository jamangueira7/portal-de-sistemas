@extends('template.admin.master')
@section('conteudo-view')
    <div class="container">
        @if($users)
            <table class="table table-striped" id="table">
                <thead class="thead-dark">
                <tr class="d-flex">
                    <th scope="col" class="col-4">Nome</th>
                    <th scope="col" class="col-1">Login</th>
                    <th scope="col" class="col-3">Email</th>
                    <th scope="col" class="col-4">Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="d-flex">
                            <td class="col-4">{{$user->name}}</td>
                            <td class="col-1">{{$user->login}}</td>
                            <td class="col-3">{{$user->email}}</td>
                            <td class="col-4">
                                <a href="{{route('admin.users.details', [$user->id])}}" type="button" class="btn btn-outline-warning">Detalhes</a>
                                <button onclick="deleteRegister('{{$user->id}}')" type="button" class="btn btn-outline-danger">Deletar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row justify-content-center">
                {{ $users->links() }}
            </div>
        @else
            <h3>Sem dados.</h3>
        @endif

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
    @include('suport.dataTable')

    <script >

        let idDeelte = '';
        function deleteRegister(id) {
            idDeelte = id;
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
                window.location = '/admin/users/delete/'+idDeelte;
            }else{
                return;
            }
        });
    </script>
@stop
