<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-title">Edit {{ $role->present()->fullName }}</div>
    </div>
    <div class="panel-body">
        {{ Form::open() }}
            {{ Form::groupOpen() }}
                {{ Form::text('id', $role->id, ['readonly' => 'readonly'], 'Id') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::text('group', $role->group, null, 'Group') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::text('name', $role->name, null, 'Name') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::text('keyName', $role->keyName, null, 'Key Name') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::text('priority', $role->priority, null, 'Priority') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::select2('actions[]', $actions, $role->actions->id->toArray(), ['multiple' => 'multiple'], 'Actions', 'Select Actions') }}
            {{ Form::groupClose() }}

            {{ Form::offsetGroupOpen() }}
                {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
            {{ Form::offsetGroupClose() }}
        {{ Form::close() }}
    </div>
</div>