<div class="text-right">
    {{ HTML::linkRoute('admin.user.role.create', 'Create New Role', [], ['class' => 'btn btn-primary']) }}
</div>
<br />
<div class="panel panel-inverse">
    <div class="panel-heading">
        Roles
    </div>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Key Name</th>
                <th>Priority</th>
                <th>Actions</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @each('admin.users.role.partials.row', $roles, 'role', 'raw|<tr><td colspan="5">No roles exist.</td></tr>')
        </tbody>
    </table>
</div>
@if ($roles->total() > $roles->perPage())
    <div class="text-center">
        {{ $roles->render() }}
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