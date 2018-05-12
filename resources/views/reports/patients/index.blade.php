@extends('layout.master')

@section('title', 'Báo cáo, thống kê bệnh nhân')
@section('link', route('reports.patients.index'))

@section('content')
    <div class="row">
        @include('commons.error')
        <div class="col-md-12">
            <div class="widget">
                {{ Form::open(['route' => 'reports.patients.statistic']) }}
                    <div class="widget-head">
                        <div>
                            <span class="time-label">Từ:</span>
                            <div class="col-sm-3">
                                <input type="date" name="time_from" class="form-control" value="{{ $data['time_from'] }}">
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control" name="faculty">
                                    <option value="{{ config('settings.reports.patients.all_faculty') }}" {{ $data['faculty'] == config('settings.reports.patients.all_faculty') ? 'selected' : '' }}>
                                        Tất cả
                                    </option>
                                    @foreach ($faculties as $faculty)
                                        <option value="{{ $faculty->id }}" {{ $data['faculty'] === $faculty->id ? 'selected' : '' }}>
                                            Khoa {{ $faculty->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                {{ Form::select('kind', [
                                    config('settings.patient_kind.all') => 'Tất cả',
                                    config('settings.patient_kind.internal') => 'Bệnh nhân nội trú',
                                    config('settings.patient_kind.external') => 'Bệnh nhân ngoại trú',
                                ], $data['kind'], ['class' => 'form-control']) }}
                            </div>
                            <div class="pull-right col-sm-2">
                                <button type="submit" class="btn add-btn report-btn" href=""><i class="fa fa-plus"></i> Thống kê </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div >
                            <span class="time-label">Đến:</span>
                            <div class="col-sm-3">
                                <input type="date" name="time_to" class="form-control" value="{{ $data['time_to'] }}">
                            </div>
                            <div class="pull-right col-sm-2">
                                <div class="btn-group">
                                    <button class="btn add-btn report-btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-download"></i> In báo cáo </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            {{ Form::open() }}
                                            {{ Form::close() }}
                                        </li>
                                        <li>
                                            <a href="#" class="export-btn">xls</a>
                                            {{ Form::open(['route' => 'reports.patients.export', 'class' => 'export-form']) }}
                                                <input type="hidden" name="type" value="xls">
                                            {{ Form::close() }}
                                        </li>
                                        <li>
                                            <a href="#" class="export-btn">xlsx</a>
                                            {{ Form::open(['route' => 'reports.patients.export', 'class' => 'export-form']) }}
                                                <input type="hidden" name="type" value="xlsx">
                                            {{ Form::close() }}
                                        </li>
                                        <li>
                                            <a href="#" class="export-btn">csv</a>
                                            {{ Form::open(['route' => 'reports.patients.export', 'class' => 'exprot-form']) }}
                                                <input type="hidden" name="type" value="csv">
                                            {{ Form::close() }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget-icons pull-right resize-icon resize-icon-report">
                            <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                        </div>
                    </div>
                {{ Form::close() }}
                <div class="widget-content" id="show-data">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="3%">No</th>
                                    <th width="7%">Mã BN</th>
                                    <th width="20%">Tên</th>
                                    <th width="12%">Ngày sinh</th>
                                    <th width="11%">SĐT</th>
                                    <th width="16%">Địa chỉ</th>
                                    <th width="13%">Mã BHYT</th>
                                    <th width="9%">Bệnh án</th>
                                    <th width="10%">Xem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $patient->id }}</td>
                                        <td>{{ $patient->name }}</td>
                                        <td>{{ $patient->birthday }}</td>
                                        <td>{{ $patient->phone }}</td>
                                        <td>{{ str_limit($patient->address, 20) }}</td>
                                        <td>{{ $patient->insurance_number }}</td>
                                        <td>
                                            <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-sm btn-success">
                                                <i class="fa fa-eye"></i> 
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-sm btn-success">
                                                <i class="fa fa-eye"></i> 
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                @if (!count($patients))
                                    <tr><td colspan="9" class="no-data"> Không có dữ liệu </td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="widget-foot">
                        {{ $patients->links() }}
                        <div class="clearfix"></div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
