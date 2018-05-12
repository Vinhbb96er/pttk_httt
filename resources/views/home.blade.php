@extends('layout.master')

@section('title', 'Trang chủ')
@section('link', route('home'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-head">
                    <div class="pull-left">
                        <h3>Thông tin nhóm AD07</h3>
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
                                    <th width="3%">No</th>
                                    <th width="20%">Họ và tên</th>
                                    <th width="10%">Mã số SV</th>
                                    <th width="15%">Lớp</th>
                                    <th width="20%">Email</th>
                                    <th width="20%">SĐT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1</td>
                                    <td>Nguyễn Quang Vĩnh</td>
                                    <td>102140053</td>
                                    <td>14T1</td>
                                    <td>vinhbb96er@gmail.com</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>#2</td>
                                    <td>Nguyễn Tri Viên</td>
                                    <td>102140052</td>
                                    <td>14T1</td>
                                    <td>nguyentrivien1996@gmail.com</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>#3</td>
                                    <td>Nguyễn Nhật Thành</td>
                                    <td>102140043</td>
                                    <td>14T1</td>
                                    <td>thanhtdk2212@gmail.com</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>#4</td>
                                    <td>Phan Văn Sanh</td>
                                    <td>102140037</td>
                                    <td>14T1</td>
                                    <td>sanhphanvan96@gmail.com</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>#5</td>
                                    <td>Phạm Văn Nhã</td>
                                    <td>102140030</td>
                                    <td>14T1</td>
                                    <td>nhapham.14t1.95@gmail.com</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
