<label for="groups">{{ $label }}</label>
<div class="form-group row">

    @foreach($model as $group)
        <div class="form-check col-4">
            <input
                class="form-check-input"
                type="checkbox"
                id="check-{{$group->id}}"
                name="groups[]"
                value="{{$group->id}}"
                {{in_array($group->id, $model_groups) ? 'checked' : ''}}
            >
            <label class="form-check-label" for="check-{{$group->id}}">{{$group->description}}</label>
        </div>
    @endforeach
</div>
