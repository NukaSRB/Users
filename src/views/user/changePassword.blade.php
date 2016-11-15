{{ Form::open() }}
    <h3>Change Your Password</h3>
    <hr />
    {{ Form::groupOpen() }}
        {{ Form::password('password', array('class' => 'input-block-level', 'placeholder' => 'Your old password'), 'Old Password', 6) }}
    {{ Form::groupClose() }}
    {{ Form::groupOpen() }}
        {{ Form::password('new_password', array('class' => 'input-block-level', 'placeholder' => 'Your new password'), 'New Password', 6) }}
    {{ Form::groupClose() }}
    {{ Form::groupOpen() }}
        {{ Form::password('new_password_confirmation', array('class' => 'input-block-level', 'placeholder' => 'Your new password again'), 'Confirm New Password', 6) }}
    {{ Form::groupClose() }}
    {{ Form::offsetGroupOpen() }}
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
    {{ Form::offsetGroupClose() }}
    <div id="message"></div>
{{ Form::close() }}