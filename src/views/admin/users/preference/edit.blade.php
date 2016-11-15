<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-title">Edit {{ $preference->present()->name }}</div>
    </div>
    <div class="panel-body">
        {{ Form::open() }}
            {{ Form::groupOpen() }}
                {{ Form::text('id', $preference->id, ['readonly' => 'readonly'], 'Id') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::text('name', $preference->name, null, 'Name') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::text('keyName', $preference->keyName, null, 'Key Name') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::textarea('description', $preference->description, ['style' => 'height: 100px'], 'Description') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::text('value', $preference->value, null, 'Value') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::text('default', $preference->default, null, 'Default') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::select('display', ['select' => 'Select', 'text' => 'Text'], $preference->display, null, 'Display') }}
            {{ Form::groupClose() }}

            {{ Form::groupOpen() }}
                {{ Form::select('hiddenFlag', ['No', 'Yes'], $preference->hiddenFlag, null, 'Hidden?') }}
            {{ Form::groupClose() }}

            {{ Form::offsetGroupOpen() }}
                {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
            {{ Form::offsetGroupClose() }}
        {{ Form::close() }}
    </div>
</div>