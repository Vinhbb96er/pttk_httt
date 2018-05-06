@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget wgreen">
                <div class="widget-head">
                    <div class="pull-left">Xem chi tiết bệnh án</div>
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
                                    <label class="col-lg-3 control-label">Mã bệnh án:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $medicalRecord->id }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Mã bệnh nhân:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $medicalRecord->patient->id }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Họ và tên:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $medicalRecord->patient->name }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Địa chỉ:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $medicalRecord->patient->address }}
                                    </label>
                                </div>
                                <div class="form-group insurance-block">
                                    <label class="col-lg-3 control-label">Mã BHYT:</label>
                                    <div class="form-group col-lg-9 insurance-block-right">
                                        <label class="col-lg-5 control-label">
                                            {{ $medicalRecord->patient->insurance_number }}
                                        </label>
                                        <div class="form-group col-lg-7 deadline-insurance">
                                            <label class="col-lg-5 control-label insurance-label">Ngày hết hạn:</label>
                                            <label class="col-lg-5 control-label">
                                                {{ $medicalRecord->patient->expiration_date_format }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Ngày lập:</label>
                                    <label class="col-lg-5 control-label">
                                        {{ $medicalRecord->create_date_format }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Khoa điều trị:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $medicalRecord->faculty->name }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Bác sĩ phụ trách:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $medicalRecord->user->name }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Bệnh trạng:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $medicalRecord->patient_status }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Giường bệnh:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $medicalRecord->bed_number }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Tình trạng:</label>
                                    <label class="col-lg-9 control-label">
                                        <span class="label medical-status-{{ $medicalRecord->status }}">
                                            {{ $medicalRecord->status_content }}
                                        </span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Ghi chú:</label>
                                    <label class="col-lg-9 control-label">
                                        {{ $medicalRecord->note }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <img src="{{ $medicalRecord->patient->image_path }}" id="img-preview">
                            </div>
                            <div class="form-group col-lg-12">
                                <div class="form-btn-block">
                                    <a href="{{ route('medical-records.index') }}" class="btn btn-md btn-default">Trở về</a>
                                    <a href="{{ route('medical-records.edit', $medicalRecord->id) }}" class="btn btn-md btn-info">Chỉnh sửa</a>
                                    {{ Form::open(['route' => ['medical-records.destroy', $medicalRecord->id], 'class' => 'btn-form']) }}
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
