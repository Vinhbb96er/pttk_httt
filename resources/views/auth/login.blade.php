<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <!-- Title and other stuffs -->
    <title>Login - MacAdmin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Stylesheets -->
    {{ Html::style('css/app.css') }}
    {{ Html::style(asset('templates/css/style.css')) }}

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon/favicon.png">
</head>
<body>
    <!-- Form area -->
    <div class="admin-form">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Widget starts -->
                    <div class="widget worange">
                        <!-- Widget head -->
                        <div class="widget-head">
                            <i class="fa fa-lock"></i> Login 
                        </div>
                        <div class="widget-content">
                            <div class="padd">
                                <!-- Login form -->
                                <form method="POST" action="{{ route('login') }}" class="form-horizontal">
                                    @csrf
                                    <!-- Account -->
                                    <div class="form-group">
                                        <label class="control-label col-lg-3" for="account">Account</label>
                                        <div class="col-lg-9">
                                            <input id="account" 
                                                type="text"
                                                class="form-control{{ $errors->has('account') ? ' is-invalid' : '' }}" 
                                                name="account" 
                                                value="{{ old('account') }}" 
                                                required autofocus 
                                                placeholder="Account">

                                            @if ($errors->has('account'))
                                                <span class="msg-danger">
                                                    <strong>{{ $errors->first('account') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Password -->
                                    <div class="form-group">
                                        <label class="control-label col-lg-3" for="password">Password</label>
                                        <div class="col-lg-9">
                                            <input id="password" 
                                            type="password" 
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                            name="password" required 
                                            placeholder="Password">
                                        </div>

                                        @if ($errors->has('password'))
                                            <span class="msg-danger">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <!-- Remember me checkbox and sign in button -->
                                    <div class="form-group">
                                        <div class="col-lg-9 col-lg-offset-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-lg-offset-3">
                                        <button type="submit" class="btn btn-info btn-md">Login</button>
                                        <button type="reset" class="btn btn-default btn-md">Reset</button>
                                    </div>
                                    <br />
                                </form>
                            </div>
                        </div>
                        <div class="widget-foot"></div>
                    </div>  
                </div>
            </div>
        </div> 
    </div>
    
    <!-- JS -->
    {{ Html::script('js/app.js') }}
    {{ Html::script(asset('templates/js/custom.js')) }}
</body>
</html>
