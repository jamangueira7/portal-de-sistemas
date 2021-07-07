<label for="groups">{{ $label }}</label>

<div class="form-group row">
    <div class="form-check col-12">
        <input
            class="form-check-input"
            type="checkbox"
            id="check-all"
            name="check-all"
            onClick="selectAll(this)"
        >
        <label class="form-check-label" for="check-all">Selecionar todos</label>
    </div>
    <br>
    <br>
    @foreach($model as $group)
        <div class="form-check col-4" >
            <input
                class="form-check-input"
                type="checkbox"
                id="check-{{$group->id}}"
                name="groups[]"
                value="{{$group->id}}"
                {{in_array($group->id, $model_groups) ? 'checked' : ''}}
            >
            <label class="form-check-label" for="check-{{$group->id}}" style="font-size: 11px;">{{$group->description}}</label>
        </div>
    @endforeach
</div>
<script>
    function selectAll(source) {
       checkboxes = document.getElementsByName('groups[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>
