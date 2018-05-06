@extends('layout.master')

@section('title', 'Quản lý nhân viên')
@section('link', route('staffs.index'))

@section('content')
    <div class="row">
        @include('commons.error')
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-head">
                    <div class="pull-left">
                        <a class="btn add-btn" href="{{ route('staffs.create') }}"><i class="fa fa-plus"></i> Thêm </a>
                    </div>
                    <div class="pull-left">
                        <a class="btn delete-all-btn" href="" id="delete-all-btn" data-url="{{ route('delete_staff') }}">
                            <i class="fa fa-trash"></i> Xóa tất cả 
                        </a>
                    </div>
                    <div class="pull-left search-block col-sm-5">
                        <input type="text" name="search" class="form-control" id="search-box" data-url="{{ route('search_staff') }}" placeholder="Nhập nội dung tìm kiếm">
                    </div>
                    <div class="pull-left">
                        <select class="form-control" id="condition-search">
                            <option value="{{ config('settings.condition_search.staffs.all') }}">
                                Tất cả
                            </option>
                            <option value="{{ config('settings.condition_search.staffs.name') }}">
                                Tên
                            </option>
                            <option value="{{ config('settings.condition_search.staffs.id') }}">
                                Mã nhân viên
                            </option>
                            <option value="{{ config('settings.condition_search.staffs.faculty') }}">
                                Khoa
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
                                    <th width="7%">Mã NV</th>
                                    <th width="20%">Tên</th>
                                    <th width="13%">Khoa</th>
                                    <th width="13%">Chức vụ</th>
                                    <th width="13%">Quyền hạn</th>
                                    <th width="13%">SĐT</th>
                                    <th width="17%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staffs as $staff)
                                    <tr>
                                        <td>
                                            @if ($staff->id != Auth::user()->id && $staff->role != config('settings.staff_role.super_admin'))
                                                <input type="checkbox" name="" class="checkbox-delete" val="{{ $staff->id }}">
                                            @endif
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $staff->id }}</td>
                                        <td>{{ $staff->name }}</td>
                                        <td>{{ str_limit($staff->faculty->name, 10) }}</td>
                                        <td>{{ str_limit($staff->position->name, 10) }}</td>
                                        <td>
                                            <span class="label label-{{ $staff->role }} status-{{ $staff->status }}">
                                                {{ str_limit($staff->role_content, 12) }}
                                            </span>
                                        </td>
                                        <td>{{ $staff->phone }}</td>
                                        <td>
                                            @if (($staff->role == config('settings.staff_role.super_admin') && Auth::user()->role == config('settings.staff_role.super_admin')) || $staff->role != config('settings.staff_role.super_admin'))
                                                <a href="{{ route('staffs.show', $staff->id) }}" class="btn btn-sm btn-success">
                                                    <i class="fa fa-eye"></i> 
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
                            </tbody>
                        </table>
                    </div>
                    <div class="widget-foot">
                        {{ $staffs->links() }}
                        <div class="clearfix"></div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
