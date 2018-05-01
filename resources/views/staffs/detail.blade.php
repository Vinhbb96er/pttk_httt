@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget wgreen">
                <div class="widget-head">
                    <div class="pull-left">Xem chi tiết nhân viên</div>
                    <div class="widget-icons pull-right">
                        <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                    <div class="padd form-content form-group">
                        <br />
                        <div class="form-horizontal">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Họ và tên:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $staff->name }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Địa chỉ:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $staff->address }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Số điện thoại:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $staff->phone }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Email:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $staff->email }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Ngày sinh:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $staff->birthday }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Giới tính:</label>
                                    <label class="col-lg-5 control-label">
                                        {{ $staff->gender }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Khoa:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $staff->faculty->name }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Chức vụ:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $staff->position->name }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Quyền hạn:</label>
                                    <label class="col-lg-9 control-label">
                                        <span class="label label-{{ $staff->role }} status-{{ $staff->status }}" id="staff-status">
                                            {{ $staff->role_content }}
                                        </span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Tài khoản:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $staff->account }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <img src="{{ $staff->image_path }}" id="img-preview" >
                            </div>
                            <div class="form-group col-lg-12">
                                <div class="form-btn-block">
                                    <a href="{{ route('staffs.index') }}" class="btn btn-md btn-default">Trở về</a>
                                    <button type="submit" class="btn btn-md btn-info">Chỉnh sửa</button>
                                    @if ($staff->id != Auth::user()->id && $staff->role != config('settings.staff_role.super_admin'))
                                        <button class="btn btn-md btn-lock-{{ $staff->status }}" id="lock-staff" val="{{ $staff->status }}" data-url="{{ route('change_status') }}" data-staff="{{ $staff->id }}">
                                            {{ ($staff->status) ? 'Khóa' : 'Mở khóa' }}
                                        </button>
                                        {{ Form::open(['route' => ['staffs.destroy', $staff->id], 'class' => 'btn-form']) }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-md btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này không?')">Xóa</button>
                                        {{ Form::close() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{ Form::open(['route' => 'staffs.store', 'files' => true, 'class' => 'form-horizontal']) }}
                        {{ Form::close() }}
                    </div>
                </div>
                <div class="widget-foot"></div>
          </div>  
        </div>
    </div>
@endsection
