{{ Form::open() }}
    <h3>Personal Information</h3>
    <hr />
    <div class="row">
        <div class="col-md-6">
            {{ Form::groupOpen() }}
                {{ Form::text('displayName', Auth::user()->displayName, ['placeholder' => 'How a stranger should greet you.'], 'Display Name') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::text('firstName', Auth::user()->firstName, ['placeholder' => 'The goofy name your mom gave you.'], 'First Name') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::text('lastName', Auth::user()->lastName, ['placeholder' => 'The name you almost never hear.'], 'Last Name') }}
            {{ Form::groupClose() }}
            {{ Form::offsetGroupOpen() }}
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
            {{ Form::offsetGroupClose() }}
        </div>
        <div class="col-md-6">
            {{ Form::groupOpen() }}
                {{ Form::email('email', Auth::user()->email, ['placeholder' => 'Your email address.', 'required' => 'required'], 'Email Address') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::text('location', Auth::user()->location, ['placeholder' => 'Where you live?'], 'Location') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::text('url', Auth::user()->url, ['placeholder' => 'URL of your site.'], 'URL') }}
            {{ Form::groupClose() }}
        </div>
    </div>
    <div id="message"></div>
{{ Form::close() }}