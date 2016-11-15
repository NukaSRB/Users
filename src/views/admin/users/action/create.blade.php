<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-title">Create New Action</div>
    </div>
    <div class="panel-body">
        {{ Form::open() }}
            {{ Form::groupOpen() }}
                {{ Form::text('name', null, null, 'Name') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::text('keyName', null, null, 'Key Name') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::textarea('description', null, ['style' => 'height: 100px'], 'Description') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::select2('roles[]', $roles, null, ['multiple' => 'multiple'], 'Roles', 'Select Roles') }}
            {{ Form::groupClose() }}
            {{ Form::offsetGroupOpen() }}
                {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
            {{ Form::offsetGroupClose() }}
        {{ Form::close() }}
    </div>
</div>