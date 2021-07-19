@extends('template.admin.master')
@section('conteudo-view')
    <div class="container">
        <div class="row justify-content-end row-cols-md-4 mb-2 mr-1">

            <a href="{{route('admin.groups.new')}}" type="button" class="btn btn-outline-success btn-block">Novo</a>
        </div>

        @if($groups)
            <table class="table table-striped" id="table">
                <thead class="thead-dark">
                <tr class="d-flex">
                    <th scope="col" class="col-5">Descrição</th>
                    <th scope="col" class="col-3">Registro</th>
                    <th scope="col" class="col-4">Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($groups as $group)
                        <tr class="d-flex">
                            <td class="align-bottom col-5">{{$group->description}}</td>
                            <td class="col-3">{{\App\Helpers\Helper::formateDate($group->created_at)}}</td>
                            <td class="col-4">
                                <a href="{{route('admin.groups.details', [$group->id])}}" type="button" class="btn btn-outline-warning">Detalhes</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row justify-content-center">
                {{ $groups->links() }}
            </div>
        @else
            <h3>Sem dados.</h3>
        @endif

    </div>

@stop

@section('js-view')
    @include('suport.dataTable')
@stop

