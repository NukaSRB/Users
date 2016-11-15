<tr>
    <td>{{ $action->present()->name }}</td>
    <td>{{ $action->present()->keyName }}</td>
    <td><a href="javascript:void(0);" class="viewDetails popover-dismiss" data-toggl="popover" title="Roles for {{ $action->present()->name }}" data-content="{{ $action->present()->roleList }}">View</a></td>
    <td class="text-right">
        <div class="btn-group">
            <a href="{{ URL::route('admin.user.action.edit', ['id' => $action->id], false) }}" class="btn btn-xs btn-primary">
                <i class="fa fa-edit"></i>
            </a>
            {{ HTML::linkRouteIcon('admin.user.action.delete', ['id' => $action->id], 'fa fa-trash-o', null, ['class' => 'confirm-remove btn btn-xs btn-danger'])  }}
        </div>
    </td>
</tr>