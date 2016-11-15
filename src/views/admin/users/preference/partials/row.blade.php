<tr>
    <td>{{ $preference->present()->name }}</td>
    <td>{{ $preference->present()->value }}</td>
    <td>{{ $preference->present()->default }}</td>
    <td class="text-right">
        <div class="btn-group">
            <a href="{{ URL::route('admin.user.preference.edit', ['id' => $preference->id], false) }}" class="btn btn-xs btn-primary">
                <i class="fa fa-edit"></i>
            </a>
            {{ HTML::linkRouteIcon('admin.user.preference.delete', ['id' => $preference->id], 'fa fa-trash-o', null, ['class' => 'confirm-remove btn btn-xs btn-danger'])  }}
        </div>
    </td>
</tr>