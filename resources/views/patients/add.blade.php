@extends('layout.master')

@section('title', 'Quản lý bệnh nhân')
@section('link', route('patients.index'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget wgreen">
                <div class="widget-head">
                    <div class="pull-left">Thêm bệnh nhân</div>
                    <div class="widget-icons pull-right">
                        <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                    <div class="padd form-content form-group">
                        <br />
                        <!-- Form starts.  -->
                        {{ Form::open(['route' => 'patients.store', 'files' => true, 'class' => 'form-horizontal']) }}
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
                                <div class="form-group insurance-block">
                                    <label class="col-lg-3 control-label">Mã BHYT</label>
                                    <div class="form-group col-lg-9 insurance-block-right">
                                        <div class="col-lg-5">
                                            <input type="text" 
                                                name="insurance_number" 
                                                class="form-control" 
                                                placeholder="Mã BHYT" 
                                                value="{{ old('insurance_number') }}">

                                            @if ($errors->has('insurance_number'))
                                                <span class="msg-danger">
                                                    <strong>{{ $errors->first('insurance_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-lg-7 deadline-insurance">
                                            <label class="col-lg-5 control-label insurance-label">Ngày hết hạn</label>
                                            <div class="col-lg-7 date-input-insurance">
                                                <input type="date" 
                                                    name="expiration_date" 
                                                    class="form-control"
                                                    value="{{ old('expiration_date') }}">

                                                @if ($errors->has('expiration_date'))
                                                    <span class="msg-danger">
                                                        <strong>{{ $errors->first('expiration_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Ngày tiếp nhận(*)</label>
                                    <div class="col-lg-5">
                                        <input type="date" name="reception_date" 
                                            class="form-control"
                                            value="{{ old('reception_date') }}"
                                            required>

                                        @if ($errors->has('reception_date'))
                                            <span class="msg-danger">
                                                <strong>{{ $errors->first(' reception_date') }}</strong>
                                            </span>
                                        @endif
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
                                    <a href="{{ route('patients.index') }}" class="btn btn-md btn-default">Trở về</a>
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
