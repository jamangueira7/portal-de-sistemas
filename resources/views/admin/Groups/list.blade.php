@extends('template.admin.master')
@section('conteudo-view')
    <div class="container">
        @if($groups)
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <th scope="row">{{$group->id}}</th>
                            <td>{{$group->description}}</td>
                            <td>
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

