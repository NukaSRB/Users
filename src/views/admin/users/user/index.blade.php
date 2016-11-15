<div class="text-right">
    {{ HTML::linkRoute('admin.user.user.create', 'Create New User', [], ['class' => 'btn btn-primary']) }}
</div>
<br />
<div class="panel panel-inverse">
    <div class="panel-heading">
        Users
    </div>
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Roles</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            @each('admin.users.user.partials.row', $users, 'user', 'raw|<tr><td colspan="4">No users exist.</td></tr>')
        </tbody>
    </table>
</div>
@if ($users->total() > $users->perPage())
    <div class="text-center">
        {{ $users->render() }}
    </div>
@endif

<script>
    @section('onReadyJs')
        $('.viewDetails').popover({
            trigger: 'hover',
            html: true
        });
    @stop
</script>