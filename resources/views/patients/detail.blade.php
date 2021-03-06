@extends('layout.master')

@section('title', 'Quản lý bệnh nhân')
@section('link', route('patients.index'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget wgreen">
                <div class="widget-head">
                    <div class="pull-left">Xem chi tiết bệnh nhân</div>
                    <div class="widget-icons pull-right">
                        <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                    <div class="padd form-content form-group">
                        <br />
                        <!-- Form starts.  -->
                        <div class="form-horizontal">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Họ và tên:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $patient->name }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Ngày sinh:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $patient->birthday_format }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Giới tính:</label>
                                    <label class="col-lg-5 control-label">
                                        {{ $patient->gender_content }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Số điện thoại:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $patient->phone }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Địa chỉ:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $patient->address }}
                                    </label>
                                </div>
                                <div class="form-group insurance-block">
                                    <label class="col-lg-3 control-label">Mã BHYT:</label>
                                    <div class="form-group col-lg-9 insurance-block-right">
                                        <label class="col-lg-5 control-label">
                                            {{ $patient->insurance_number }}
                                        </label>
                                        <div class="form-group col-lg-7 deadline-insurance">
                                            <label class="col-lg-5 control-label insurance-label">Ngày hết hạn:</label>
                                            <label class="col-lg-5 control-label">
                                                {{ $patient->expiration_date_format }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Loại:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $patient->kind_content }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Ngày tiếp nhận:</label>
                                    <label class="col-lg-5 control-label">
                                        {{ $patient->reception_date_format }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <img src="{{ $patient->image_path }}" id="img-preview">
                            </div>
                            <div class="form-group col-lg-12">
                                <div class="form-btn-block">
                                    <a href="{{ route('patients.index') }}" class="btn btn-md btn-default">Trở về</a>
                                    <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-md btn-info">Chỉnh sửa</a>
                                    {{ Form::open(['route' => ['patients.destroy', $patient->id], 'class' => 'btn-form']) }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-md btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bệnh nhân này không?')">Xóa</button>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget-foot"></div>
            </div>  
        </div>
    </div>
@endsection
