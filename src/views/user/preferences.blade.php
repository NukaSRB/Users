{{ Form::open() }}
    <h3>Preferences</h3>
    <hr />
    @foreach ($preferences as $preference)
        {{ Form::groupOpen(2, 4) }}
            {{ Form::select(
                'preference['. $preference->keyName .']',
                $preference->getPreferenceOptionsArray(),
                Auth::user()->getPreferenceValueByKeyName($preference->keyName),
                array(),
                $preference->name
            ) }}
            {{ Form::help($preference->description) }}
        {{ Form::groupClose() }}
    @endforeach
    {{ Form::offsetGroupOpen() }}
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
    {{ Form::offsetGroupClose() }}
    <div id="message"></div>
{{ Form::close() }}