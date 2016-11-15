<div class="jumbotron" style="margin-left: -5%;margin-right: -5%;margin-bottom: 0;padding: 10px 60px;background: #3a3a3a;color: #fff">
	<div class="row">
		<div class="col-md-4">
			{{ HTML::image($user->present()->image, null, ['class'=> 'media-object pull-left', 'style' => 'width: 150px;']) }}
		</div>
		<div class="col-md-offset-4 col-md-4">
			<table class="table table-hover table-condensed table-inner text-right">
				<tbody>
                    <tr><td>{{ $user->present()->username }}&nbsp;&nbsp;<i class="fa fa-user"></i></td></tr>
                    <tr><td>{{ $user->present()->fullName }}&nbsp;&nbsp;<i class="fa fa-dot-circle-o"></i></td></tr>
                    @unless ($user->present()->emailLink == null)
                        <tr><td>{{ $user->present()->emailLink }}&nbsp;&nbsp;<i class="fa fa-envelope"></i></td></tr>
                    @endunless
                    <tr><td>Joined on {{ $user->created_at->format('M dS, Y') }}&nbsp;&nbsp;<i class="fa fa-calendar"></i></td></tr>
                    <tr><td>Last seen {{ $user->lastActive ? $user->lastActive->diffForHumans() : 'never' }}&nbsp;&nbsp;<i class="fa fa-clock-o"></i></td></tr>
                    <tr><td>{{ $user->present()->online(true) }}</td></tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="jumbotron bg-inverse" style="margin-left: -5%;margin-right: -5%;padding: 10px 60px;">
	<div class="row">
		<div class="col-md-12">
            <div class="pull-left">
                <h2>
                    {{ $user->present()->username }}'s Profile
                    @if (Auth::check() && $user->id == Auth::id())
                        {{ HTML::link('user/account', 'Edit Your Profile', ['class' => 'btn btn-primary', 'style' => 'margin-left: 10px;']) }}
                    @endif
                </h2>
            </div>
            <div class="clearfix"></div>
		</div>
	</div>
</div>
@yield('userStats')