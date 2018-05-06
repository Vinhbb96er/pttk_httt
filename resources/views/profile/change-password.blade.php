@extends('layout.master')

@section('title', 'Quản lý tài khoản')
@section('link', route('profile.index'))

@section('content')
    <div class="row">
        @include('commons.error')
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
                        {{ Form::open(['route' => 'profile.store', 'class' => 'form-horizontal']) }}
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Mật khẩu cũ(*)</label>
                                <div class="col-lg-6">
                                    <input type="password" name="old_password" 
                                        class="form-control" 
                                        placeholder="Mật khẩu cũ"
                                        >

                                    @if ($errors->has('old_password'))
                                        <span class="msg-danger">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Mật khẩu mới(*)</label>
                                <div class="col-lg-6">
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
                                <div class="col-lg-6">
                                    <input type="password" 
                                        name="password_confirmation" 
                                        id="password-confirm" 
                                        class="form-control" 
                                        placeholder="Xác nhận mật khẩu"
                                        >
                                </div>
                            </div>
                            <div class="form-group col-lg-12">
                                <div class="form-btn-block">
                                    <a href="{{ route('profile.index') }}" class="btn btn-md btn-default">Trở về</a>
                                    <button type="submit" class="btn btn-md btn-info">Lưu</button>
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
