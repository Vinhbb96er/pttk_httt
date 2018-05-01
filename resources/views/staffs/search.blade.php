@foreach ($staffs as $staff)
    <tr>
        <td>
            @if ($staff->id != Auth::user()->id && $staff->role != config('settings.staff_role.super_admin'))
                <input type="checkbox" name="">
            @endif
        </td>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $staff->id }}</td>
        <td>{{ $staff->name }}</td>
        <td>{{ $staff->faculty->name }}</td>
        <td>{{ $staff->position->name }}</td>
        <td>
            <span class="label label-{{ $staff->role }} status-{{ $staff->status }}">
                {{ $staff->role_content }}
            </span>
        </td>
        <td>{{ $staff->phone }}</td>
        <td>
            @if (($staff->role == config('settings.staff_role.super_admin') && Auth::user()->role == config('settings.staff_role.super_admin')) || $staff->role != config('settings.staff_role.super_admin'))
                <a href="{{ route('staffs.show', $staff->id) }}" class="btn btn-sm btn-success">
                    <i class="fa fa-check"></i> 
                </a>
                <a href="{{ route('staffs.edit', $staff->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> </a>
                @if ($staff->id != Auth::user()->id)
                    {{ Form::open(['route' => ['staffs.destroy', $staff->id], 'class' => 'btn-form']) }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này không?')">
                            <i class="fa fa-times"></i> 
                        </button>
                    {{ Form::close() }}
                @endif
            @endif
        </td>
    </tr>
@endforeach
@if (!count($staffs))
    <tr><td colspan="9" class="no-data"> Không có dữ liệu </td></tr>
@endif
