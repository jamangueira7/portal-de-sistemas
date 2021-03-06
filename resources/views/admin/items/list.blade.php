@extends('template.admin.master')
@section('conteudo-view')

    <div class="container">
        <div class="row  justify-content-end row-cols-md-4 mb-2 mr-1">
            <a href="{{route('admin.items.new')}}" type="button" class="btn btn-outline-success btn-block">Novo</a>
        </div>

        @if($items)
            <table class="table table-striped" id="table">
                <thead class="thead-dark">
                <tr class="d-flex">
                    <th scope="col" class="col-4">Titulo</th>
                    <th scope="col" class="col-2">Registrado</th>
                    <th scope="col" class="col-2">Página</th>
                    <th scope="col" class="col-4">Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr class="d-flex">
                            <td class="col-4">{{$item->title}}</td>
                            <td class="col-2">{{\App\Helpers\Helper::formateDate($item->created_at)}}</td>
                            <td class="col-2">{{$item->page->description ?? ''}}</td>
                            <td class="col-4">
                                <a href="{{route('admin.items.details', [$item->id])}}" type="button" class="btn btn-outline-warning">Detalhes</a>

                                <button onclick="deleteRegister('{{$item->id}}')" type="button" class="btn btn-outline-danger">Deletar</button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row justify-content-center">
                {{ $items->links() }}
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
                window.location = '/admin/items-menu/delete/'+idDeelte;
            }else{
                return;
            }
        });
    </script>
@stop

