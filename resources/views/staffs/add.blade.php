@extends('layout.master')

@section('title', 'Quản lý nhân viên')
@section('link', route('staffs.index'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget wgreen">
                <div class="widget-head">
                    <div class="pull-left">Thêm nhân viên</div>
                    <div class="widget-icons pull-right">
                        <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                    <div class="padd form-content form-group">
                        <br />
                        <!-- Form starts.  -->
                        {{ Form::open(['route' => 'staffs.store', 'files' => true, 'class' => 'form-horizontal']) }}
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Họ và tên(*)</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="name" 
                                            class="form-control" 
                                            placeholder="Họ và tên" 
                                            value="{{ old('name') }}" 
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
                                            value="{{ old('address') }}"
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
                                            value="{{ old('phone') }}"
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
                                            value="{{ old('email') }}"
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
                                            value="{{ old('birthday') }}"
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
                                            <input type="radio" name="gender" value="1" checked> Nam
                                        </label>
                                        <label class="gender-radio">
                                            <input type="radio" name="gender" value="0"> Nữ
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
                                        <select class="form-control" name="faculty" value="{{ old('faculty') }}">
                                            @foreach ($faculties as $faculty)
                                                <option value="{{ $faculty->id }}">
                                                    {{ $faculty->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Chức vụ(*)</label>
                                    <div class="col-lg-5">
                                        <select class="form-control" name="position_id" value="{{ old('position') }}">
                                            @foreach ($positions as $position)
                                                <option value="{{ $position->id }}">
                                                    {{ $position->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Quyền hạn(*)</label>
                                    <div class="col-lg-5">
                                        <select class="form-control" name="role" value="{{ old('role') }}">
                                            <option value="{{ config('settings.staff_role.admin') }}">
                                                Admin
                                            </option>
                                            <option value="{{ config('settings.staff_role.front_desk_staff') }}">
                                                Nhân viên tiếp nhận
                                            </option>
                                            <option value="{{ config('settings.staff_role.faculty_staff') }}">
                                                Nhân viên khoa
                                            </option>
                                        </select>

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
                                        <select class="form-control" name="status" value="{{ old('status') }}">
                                            <option value="{{ config('settings.staff_status.active') }}">
                                                Hoạt động
                                            </option>
                                            <option value="{{ config('settings.staff_status.lock') }}">
                                                Bị khóa
                                            </option>
                                        </select>
                                        
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
                                            value="{{ old('account') }}"
                                            required>

                                        @if ($errors->has('account'))
                                            <span class="msg-danger">
                                                <strong>{{ $errors->first('account') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Mật khẩu(*)</label>
                                    <div class="col-lg-9">
                                        <input type="password" name="password" 
                                            class="form-control" 
                                            placeholder="Mật khẩu"
                                            required>

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
                                            placeholder="Xác nhận mật khẩu"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <img src="{{ config('settings.image_default.no_image') }}" id="img-preview" >
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
