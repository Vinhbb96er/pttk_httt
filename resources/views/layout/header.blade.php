<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <!-- Title and other stuffs -->
    <title>Dashboard - MacAdmin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Css -->
    {{ Html::style('css/app.css') }}
    {{ Html::style(asset('templates/css/style.css')) }}

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon/favicon.png">
</head>
<body>
    <div class="navbar navbar-fixed-top bs-docs-nav" role="banner">
        <div class="conjtainer">
            <!-- Navigation starts -->
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown pull-right">
                        @auth
                            <a data-toggle="dropdown" class="dropdown-toggle user-menu" href="#">
                                <img src="{{ Auth::user()->image_path }}" class="avatar"> 
                                {{ Auth::user()->name }} <b class="caret"></b>
                            </a>
                            <!-- Dropdown menu -->
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#"><i class="fa fa-user"></i> Profile</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-cogs"></i> Settings</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i> 
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        @endauth
                    </li>
                </ul>
            </nav>
        </div>
    </div>


    <!-- Header starts -->
    <header>
        <div class="container">
            <div class="row">
                <!-- Logo section -->
                <div class="col-md-4">
                    <!-- Logo. -->
                    <div class="logo">
                        <h1><a href="#">Mac<span class="bold">Admin</span></a></h1>
                        <p class="meta">something goes in meta area</p>
                    </div>
                    <!-- Logo ends -->
                </div>
            </div>
        </div>
    </header>
    <!-- Header ends -->

    <!-- Main content starts -->
    <div class="content">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-dropdown"><a href="#">Menu</a></div>
            <!--- Sidebar navigation -->
            <ul id="nav">
                <!-- Main menu with font awesome icon -->
                <li class="open">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="has_sub">
                    <a href="#">
                        <i class="fa fa-user"></i> 
                        Quản lý Nhân viên 
                        <span class="pull-right">
                            <i class="fa fa-chevron-right menu-icon-right"></i>
                        </span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('staffs.index') }}"> Danh sách nhân viên</a>
                        </li>
                        <li>
                            <a href="{{ route('staffs.create') }}"> Thêm nhân viên</a>
                        </li>
                    </ul>
                </li>  
                <li class="has_sub">
                    <a href="#">
                        <i class="fa fa-file-o"></i> 
                        Pages #1  
                        <span class="pull-right">
                            <i class="fa fa-chevron-right menu-icon-right"></i>
                        </span>
                    </a>
                    <ul>
                        <li><a href="post.html">Post</a></li>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="register.html">Register</a></li>
                        <li><a href="support.html">Support</a></li>
                        <li><a href="invoice.html">Invoice</a></li>
                        <li><a href="gallery.html">Gallery</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar ends -->
