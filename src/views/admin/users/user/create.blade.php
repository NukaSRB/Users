<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-title">Create New User</div>
    </div>
    <div class="panel-alert panel-alert-info">
        The password will be set to changeme.
    </div>
    <div class="panel-body">
        {{ Form::open() }}
            {{ Form::groupOpen() }}
                {{ Form::text('username', null, null, 'Username') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::email('email', null, null, 'Email') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::text('firstName', null, null, 'First Name') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::text('lastName', null, null, 'Last Name') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::select2('roles[]', $roles, null, ['multiple' => 'multiple'], 'Roles', 'Select Roles') }}
            {{ Form::groupClose() }}
            {{ Form::offsetGroupOpen() }}
                {{ Form::submit('Save User', ['class' => 'btn btn-primary']) }}
            {{ Form::offsetGroupClose() }}
        {{ Form::close() }}
    </div>
</div>