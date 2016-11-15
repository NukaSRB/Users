<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-title">Update {{ $user->present()->username }}</div>
    </div>
    <div class="panel-body">
        {{ Form::open() }}
            {{ Form::groupOpen() }}
                {{ Form::text('id', $user->id, ['readonly' => 'readonly'], 'Id') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::text('username', $user->username, null, 'Username') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::email('email', $user->email, null, 'Email') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::text('firstName', $user->firstName, null, 'First Name') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::text('lastName', $user->lastName, null, 'Last Name') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::select2('roles[]', $roles, $user->roles->id->toArray(), ['multiple' => 'multiple'], 'Roles', 'Select Roles') }}
            {{ Form::groupClose() }}
            {{ Form::offsetGroupOpen() }}
                {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
            {{ Form::offsetGroupClose() }}
        {{ Form::close() }}
    </div>
</div>