@extends('template.admin.master')
@section('conteudo-view')
    <div class="container">
        <div class="row  justify-content-end row-cols-md-4 mb-2 mr-1">
            <a href="{{route('admin.items.new')}}" type="button" class="btn btn-outline-success btn-block">Novo</a>
        </div>
        @if($items)
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Registrado</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->title}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                <a href="{{route('admin.items.details', [$item->id])}}" type="button" class="btn btn-outline-warning">Detalhes</a>
                                <butaton type="button" class="btn btn-outline-danger">Deletar</butaton>
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

@stop

