<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-title">Create New Role</div>
    </div>
    <div class="panel-body">
        {{ Form::open() }}
            {{ Form::groupOpen() }}
                {{ Form::text('group', null, null, 'Group') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::text('name', null, null, 'Name') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::text('keyName', null, null, 'Key Name') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::text('priority', null, null, 'Priority') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::select2('actions[]', $actions, null, ['multiple' => 'multiple'], 'Actions', 'Select Actions') }}
            {{ Form::groupClose() }}

            {{ Form::offsetGroupOpen() }}
                {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
            {{ Form::offsetGroupClose() }}
        {{ Form::close() }}
    </div>
</div>