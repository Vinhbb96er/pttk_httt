@include('layout.header')

<!-- Main bar -->
<div class="mainbar">
    <!-- Page heading -->
    <div class="page-head">
        <h2 class="pull-left"><i class="fa fa-home"></i> @yield('title')</h2>
        <!-- Breadcrumb -->
        <div class="bread-crumb pull-right">
            <a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang chủ</a> 
            <span class="divider">/</span> 
            <a href="@yield('link')" class="bread-current">@yield('title')</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- Page heading ends -->

    <!-- Matter -->
    <div class="matter">
        <div class="container">
            @yield('content')
        </div>
    </div>
    <!-- Matter ends -->
</div>
<!-- Mainbar ends -->
<div class="clearfix"></div>

@include('layout.footer')