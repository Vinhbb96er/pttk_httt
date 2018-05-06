@extends('layout.master')

@section('title', 'Quản lý bệnh nhân')
@section('link', route('patients.index'))

@section('content')
    <div class="row">
        @include('commons.error')
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-head">
                    <div class="pull-left">
                        <a class="btn add-btn" href="{{ route('patients.create') }}"><i class="fa fa-plus"></i> Thêm </a>
                    </div>
                    <div class="pull-left">
                        <a class="btn delete-all-btn" href="" id="delete-all-btn" data-url="{{ route('delete_patient') }}">
                            <i class="fa fa-trash"></i> Xóa tất cả 
                        </a>
                    </div>
                    <div class="pull-left search-block col-sm-5">
                        <input type="text" name="search" class="form-control" id="search-box" data-url="{{ route('search_patient') }}" placeholder="Nhập nội dung tìm kiếm">
                    </div>
                    <div class="pull-left">
                        <select class="form-control" id="condition-search">
                            <option value="{{ config('settings.condition_search.patients.all') }}">
                                Tất cả
                            </option>
                            <option value="{{ config('settings.condition_search.patients.name') }}">
                                Tên
                            </option>
                            <option value="{{ config('settings.condition_search.patients.id') }}">
                                Mã Bệnh nhân
                            </option>
                            <option value="{{ config('settings.condition_search.patients.insurance_number') }}">
                                Mã BHYT
                            </option>
                        </select>
                    </div>
                    <div class="widget-icons pull-right resize-icon">
                        <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="widget-content" id="show-data">
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
                    <div class="widget-foot">
                        {{ $patients->links() }}
                        <div class="clearfix"></div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
