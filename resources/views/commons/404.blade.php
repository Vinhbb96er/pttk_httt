<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <!-- Title and other stuffs -->
    <title>Bệnh viện Liên Chiểu - Đà Nẵng</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Css -->
    {{ Html::style('css/app.css') }}
    {{ Html::style(asset('templates/css/style.css')) }}

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ config('settings.web_icon') }}">
</head>
<body>
    <div class="error-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Widget starts -->
                    <div class="widget">
                        <!-- Widget head -->
                        <div class="widget-head">
                            <i class="fa fa-question-circle"></i> Lỗi 
                        </div>
                        <div class="widget-content">
                            <div class="padd error">
                                <h1>404 Error! Page not found</h1>
                                <p>Trang mà bạn nhập không tồn tại. </p>
                                <br />
                                <a href="{{ route('home') }}" class="btn btn-info" type="button">Trở về Trang chủ</a>
                            </div>
                            <div class="widget-foot"></div>
                        </div>
                    </div>  
                </div>
            </div>
        </div> 
    </div>
</body>
</html>
