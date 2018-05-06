{{ Html::style(asset('templates/css/style.css')) }}
{{ Html::script(asset('templates/js/search.js')) }}

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>
                    <input type="checkbox" name="" class="checkbox-delete-all">
                </th>
                <th width="3%">No</th>
                <th width="7%">Mã BN</th>
                <th width="20%">Tên</th>
                <th width="12%">Ngày sinh</th>
                <th width="11%">SĐT</th>
                <th width="18%">Địa chỉ</th>
                <th width="13%">Mã BHYT</th>
                <th width="14%">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td>
                        <input type="checkbox" name="" class="checkbox-delete" val="{{ $patient->id }}">
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->birthday }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td>{{ str_limit($patient->address, 20) }}</td>
                    <td>{{ $patient->insurance_number }}</td>
                    <td>
                        <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-sm btn-success">
                            <i class="fa fa-eye"></i> 
                        </a>
                        <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> </a>
                        {{ Form::open(['route' => ['patients.destroy', $patient->id], 'class' => 'btn-form']) }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này không?')">
                                <i class="fa fa-times"></i> 
                            </button>
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            @if (!count($patients))
                <tr><td colspan="9" class="no-data"> Không có dữ liệu </td></tr>
            @endif
        </tbody>
    </table>
</div>
