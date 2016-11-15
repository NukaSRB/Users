<div class="text-right">
    {{ HTML::linkRoute('admin.user.action.create', 'Create New Action', [], ['class' => 'btn btn-primary']) }}
</div>
<br />
<div class="panel panel-inverse">
    <div class="panel-heading">
        Actions
    </div>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Key Name</th>
                <th>Roles</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @each('admin.users.action.partials.row', $actions, 'action', 'raw|<tr><td colspan="4">No actions exist.</td></tr>')
        </tbody>
    </table>
</div>
@if ($actions->total() > $actions->perPage())
    <div class="text-center">
        {{ $actions->render() }}
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