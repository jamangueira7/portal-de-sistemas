@extends('template.admin.master')
@section('conteudo-view')
<section class="mt-5 pt-5">

    <div class="container">
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
                                <button type="button" class="btn btn-outline-warning">Detalhes</button>
                                <button type="button" class="btn btn-outline-info">Alterar</button>
                                <button type="button" class="btn btn-outline-danger">Deletar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3>Sem dados.</h3>
        @endif


    </div>

</section>

@stop

