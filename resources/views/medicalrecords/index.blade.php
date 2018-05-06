@extends('layout.master')

@section('content')
    <div class="row">
        @include('commons.error')
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-head">
                    <div class="pull-left">
                        <a class="btn add-btn" href="{{ route('medical-records.create') }}"><i class="fa fa-plus"></i> Thêm </a>
                    </div>
                    <div class="pull-left">
                        <a class="btn delete-all-btn" href="" id="delete-all-btn" data-url="{{ route('delete_medical_record') }}">
                            <i class="fa fa-trash"></i> Xóa tất cả 
                        </a>
                    </div>
                    <div class="pull-left search-block col-sm-5">
                        <input type="text" name="search" class="form-control" id="search-box" data-url="{{ route('search_medical_record') }}" placeholder="Nhập nội dung tìm kiếm">
                    </div>
                    <div class="pull-left">
                        <select class="form-control" id="condition-search">
                            <option value="{{ config('settings.condition_search.medical_records.all') }}">
                                Tất cả
                            </option>
                            <option value="{{ config('settings.condition_search.medical_records.name') }}">
                                Tên
                            </option>
                            <option value="{{ config('settings.condition_search.medical_records.id') }}">
                                Mã Bệnh án
                            </option>
                            <option value="{{ config('settings.condition_search.medical_records.insurance_number') }}">
                                Mã BHYT
                            </option>
                            <option value="{{ config('settings.condition_search.medical_records.faculty') }}">
                                Khoa điều trị
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
                                    <th width="7%">Mã BA</th>
                                    <th width="20%">Tên</th>
                                    <th width="15%">Địa chỉ</th>
                                    <th width="13%">Mã BHYT</th>
                                    <th width="13%">Khoa điều trị</th>
                                    <th width="13%">Trạng thái</th>
                                    <th width="17%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicalRecords as $medicalRecord)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="" class="checkbox-delete" val="{{ $medicalRecord->id }}">
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $medicalRecord->id }}</td>
                                        <td>{{ $medicalRecord->patient->name }}</td>
                                        <td>{{ str_limit($medicalRecord->patient->address, 20) }}</td>
                                        <td>{{ $medicalRecord->patient->insurance_number }}</td>
                                        <td>{{ $medicalRecord->faculty->name }}</td>
                                        <td>
                                            <span class="label medical-status-{{ $medicalRecord->status }}">
                                                {{ $medicalRecord->status_content }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('medical-records.show', $medicalRecord->id) }}" class="btn btn-sm btn-success">
                                                <i class="fa fa-eye"></i> 
                                            </a>
                                            <a href="{{ route('medical-records.edit', $medicalRecord->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> </a>
                                            {{ Form::open(['route' => ['medical-records.destroy', $medicalRecord->id], 'class' => 'btn-form']) }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này không?')">
                                                    <i class="fa fa-times"></i> 
                                                </button>
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                                @if (!count($medicalRecords))
                                    <tr><td colspan="9" class="no-data"> Không có dữ liệu </td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="widget-foot">
                        {{ $medicalRecords->links() }}
                        <div class="clearfix"></div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
