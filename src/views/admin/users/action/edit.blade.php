<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-title">Edit {{ $action->present()->name }}</div>
    </div>
    <div class="panel-body">
        {{ Form::open() }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::text('id', $action->id, ['readonly' => 'readonly'], 'Id') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::text('name', $action->name, null, 'Name') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::text('keyName', $action->keyName, null, 'Key Name') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::textarea('description', $action->description, ['style' => 'height: 100px'], 'Description') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::select2('roles[]', $roles, $action->roles->id->toArray(), ['multiple' => 'multiple'], 'Roles', 'Select Roles') }}
            {{ Form::groupClose() }}
            {{ Form::offsetGroupOpen() }}
                {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
            {{ Form::offsetGroupClose() }}
        {{ Form::close() }}
    </div>
</div>