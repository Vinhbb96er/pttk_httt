@extends('layout.master')

@section('title', 'Quản lý tài khoản')
@section('link', route('profile.index'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget wgreen">
                <div class="widget-head">
                    <div class="pull-left">Sửa thông tin cá nhân</div>
                    <div class="widget-icons pull-right">
                        <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                    <div class="padd form-content form-group">
                        <br />
                        <!-- Form starts.  -->
                        {{ Form::open(['route' => ['profile.update', 'update'], 'files' => true, 'class' => 'form-horizontal']) }}
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
                                <input type="file" name="image" class="form-control" id="img-upload">

                                @if ($errors->has('image'))
                                    <span class="msg-danger">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-12">
                                <div class="form-btn-block">
                                    <a href="{{ route('profile.index') }}" class="btn btn-md btn-default">Trở về</a>
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
