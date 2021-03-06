@extends('layout.master')

@section('title', 'Quản lý nhân viên')
@section('link', route('staffs.index'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget wgreen">
                <div class="widget-head">
                    <div class="pull-left">Sửa nhân viên</div>
                    <div class="widget-icons pull-right">
                        <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                    <div class="padd form-content form-group">
                        <br />
                        <!-- Form starts.  -->
                        {{ Form::open(['route' => ['staffs.update', $staff->id], 'files' => true, 'class' => 'form-horizontal']) }}
                            {{ method_field('PUT') }}
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Họ và tên(*)</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="name" 
                                            class="form-control" 
                                            placeholder="Họ và tên" 
                                            value="{{ $staff->name }}" 
                                            required>
                                    
                                        @if ($errors->has('name'))
                                            <span class="msg-danger">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Địa chỉ(*)</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="address" 
                                            class="form-control" 
                                            placeholder="Địa chỉ" 
                                            value="{{ $staff->address }}"
                                            required>
                                    
                                        @if ($errors->has('address'))
                                            <span class="msg-danger">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Số điện thoại(*)</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="phone" 
                                            class="form-control" 
                                            placeholder="Số điện thoại" 
                                            value="{{ $staff->phone }}"
                                            required>

                                        @if ($errors->has('phone'))
                                            <span class="msg-danger">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Email(*)</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="email" 
                                            class="form-control" 
                                            placeholder="Email" 
                                            value="{{ $staff->email }}"
                                            required>

                                        @if ($errors->has('email'))
                                            <span class="msg-danger">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Ngày sinh(*)</label>
                                    <div class="col-lg-5">
                                        <input type="date" name="birthday" 
                                            class="form-control" 
                                            value="{{ $staff->birthday }}"
                                            required>

                                        @if ($errors->has('birthday'))
                                            <span class="msg-danger">
                                                <strong>{{ $errors->first('birthday') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Giới tính(*)</label>
                                    <div class="col-lg-5">
                                        <label class="gender-radio">
                                            <input type="radio" name="gender" value="1" {{ $staff->gender ? 'checked' : ''}}> Nam
                                        </label>
                                        <label class="gender-radio">
                                            <input type="radio" name="gender" value="0" {{ $staff->gender ? '' : 'checked'}}> Nữ
                                        </label>

                                        @if ($errors->has('gender'))
                                            <span class="msg-danger">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Khoa(*)</label>
                                    <div class="col-lg-5">
                                        <select class="form-control" name="faculty_id" value="">
                                            @foreach ($faculties as $faculty)
                                                <option value="{{ $faculty->id }}" {{ $faculty->id == $staff->faculty->id ? 'selected' : '' }}>
                                                    {{ $faculty->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Chức vụ(*)</label>
                                    <div class="col-lg-5">
                                        <select class="form-control" name="position_id" value="">
                                            @foreach ($positions as $position)
                                                <option value="{{ $position->id }}" {{ $position->id == $staff->position->id ? 'selected' : '' }}>
                                                    {{ $position->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($staff->role != config('settings.staff_role.super_admin'))
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Quyền hạn</label>
                                        <div class="col-lg-5">
                                            {{ Form::select('role', [
                                                config('settings.staff_role.admin') => 'Admin',
                                                config('settings.staff_role.front_desk_staff') => 'Nhân viên tiếp nhận',
                                                config('settings.staff_role.faculty_staff') => 'Nhân viên khoa'
                                            ], $staff->role, ['class' => 'form-control']) }}

                                            @if ($errors->has('role'))
                                                <span class="msg-danger">
                                                    <strong>{{ $errors->first('role') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Trạng thái(*)</label>
                                        <div class="col-lg-5">
                                            {{ Form::select('status', [
                                                config('settings.staff_status.active') => 'Hoạt động',
                                                config('settings.staff_status.lock') => 'Bị khóa',
                                            ], $staff->status, ['class' => 'form-control']) }}

                                            @if ($errors->has('status'))
                                                <span class="msg-danger">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Tài khoản(*)</label>
                                        <div class="col-lg-9">
                                            <input type="text" name="account" 
                                                class="form-control" 
                                                placeholder="Tài khoản" 
                                                value="{{ $staff->account }}"
                                                required>

                                            @if ($errors->has('account'))
                                                <span class="msg-danger">
                                                    <strong>{{ $errors->first('account') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @else 
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Quyền hạn(*)</label>
                                        <label class="col-lg-9 control-label">
                                            <span class="label label-{{ $staff->role }} status-{{ $staff->status }}" id="staff-status">
                                                {{ $staff->role_content }}
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="account" value="{{ $staff->account }}">
                                        <label class="col-lg-3 control-label">Tài khoản(*)</label>
                                        <label class="col-lg-9 control-label">
                                            {{ $staff->account }}
                                        </label>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Mật khẩu(*)</label>
                                    <div class="col-lg-9">
                                        <input type="password" name="password" 
                                            class="form-control" 
                                            placeholder="Mật khẩu">

                                        @if ($errors->has('password'))
                                            <span class="msg-danger">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Xác nhận(*)</label>
                                    <div class="col-lg-9">
                                        <input type="password" 
                                            name="password_confirmation" 
                                            id="password-confirm" 
                                            class="form-control" 
                                            placeholder="Xác nhận mật khẩu">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <img src="{{ $staff->image_path }}" id="img-preview" >
                                <input type="file" name="image" class="form-control" id="img-upload">

                                @if ($errors->has('image'))
                                    <span class="msg-danger">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-12">
                                <div class="form-btn-block">
                                    <a href="{{ route('staffs.index') }}" class="btn btn-md btn-default">Trở về</a>
                                    <button type="submit" class="btn btn-md btn-info">Lưu</button>
                                    <button type="reset" class="btn btn-md btn-warning">Làm mới</button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
                <div class="widget-foot"></div>
          </div>  
        </div>
    </div>
@endsection
