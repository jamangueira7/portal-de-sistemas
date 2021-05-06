@extends('template.admin.master')
@section('conteudo-view')
    <div class="container col-md-10">
        <h2 class="mb-5">Alterar página</h2>
        <form method="POST" action="{{route('admin.pages.update', [$page->id])}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="description">Titulo:</label>
                <input value="{{$page->description}}" type="text" class="form-control" name="description" id="description" placeholder="Titulo">
            </div>

            <label for="groups">Grupos:</label>
            <div class="form-group row">

                @foreach($groups as $group)
                    <div class="form-check col-4">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="check-{{$group->id}}"
                            name="groups[]"
                            value="{{$group->id}}"
                            {{in_array($group->id, $page_groups) ? 'checked' : ''}}
                        >
                        <label class="form-check-label" for="check-{{$group->id}}">{{$group->description}}</label>
                    </div>
                @endforeach
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Alterar</button>
            </div>
        </form>
    </div>
@stop


