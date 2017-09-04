<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>
            @if(!empty($title))
            {{$title}}
            @if(!empty($page_title))
            | {{$page_title}}
            @endif
            @endif
        </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
        <meta content="" name="author" />

        <!-- END THEME LAYOUT STYLES -->
        <!-- <link rel="shortcut icon" href="{{ asset('public/assets/global/img/favicon.ico')}}" /> </head> -->
    <!-- END HEAD -->
    <!-- BEGIN LOGIN THEME LAYOUT STYLES -->
    <!-- <link href="{{ asset('public/assets/global/log-css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="{{ asset('public/assets/global/log-css/styles.css')}}" rel="stylesheet" type="text/css" id="style_color" /> -->
    <!-- END LOGIN THEME LAYOUT STYLES -->

    <!-- Shift CSS -->
    <script src="{{ asset('public/assets/'.AD .'/global/log-js/jquery-3.2.1.min.js')}}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.AD .'/global/log-css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.AD .'/global/log-css/styles.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.AD .'/global/log-css/selectize.css')}}">

    <body>
        <section id="login">
            <h1 id="logo">
                <a href="">Mo7amy Online</a>
            </h1>
            <div class="form-container">

                <img src="{{ asset('public/assets/'.AD .'/global/images/lock.svg')}}">
                <h3>signin</h3>
                <p>{{ trans('cpanel.enter_your_correct_data_to_access_your_site')}}.</p>
                {!! Form::open(['url'=>'login', 'class'=>'login-form']) !!}
                @if(Session::has('error_login'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span>{{ session()->get('error_login') }}</span>
                </div>
                @endif
                <div class="form-group">
                    {!! Form::email('email', old('email'), array('class'=>'form-control form-control-solid placeholder-no-fix','placeholder'=>trans('cpanel.enter_email'), 'id' => 'loginEmailInput')) !!}
                    @if ($errors->has('email'))
                    <span class="text-danger">
                        {{ $errors->first('email') }}
                    </span>
                    @else
                    <span class="input-info">{{ trans('cpanel.write_correct_mail')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::password('password', array('class'=>'form-control form-control-solid placeholder-no-fix','placeholder'=>trans('cpanel.enter_password'), 'id' => 'loginPasswordInput')) !!}
                    @if ($errors->has('password'))
                    <span class="text-danger">
                        {{ $errors->first('password') }}
                    </span>
                    @else
                    <span class="input-info">{{ trans('cpanel.write_strong_password_contains_characters_and_numbers')}}.</span>
                    @endif
                </div>
                <div class="form-group clearfix">
                    <a class="forgot-password" href="{{ route('password.request') }}">{{ trans('cpanel.forgot_your_password')}}</a>
                    <button type="submit" class="btn btn-primary btn-icon-right pull-right">{{ trans('cpanel.login') }}</button>

                    {!! Form::close() !!}
                </div>
            </div>
            <span class="copyrights">&copy; {{ trans('cpanel.copyright')}}</span>
        </section>

        <!-- BEGIN LOGIN SCRIPTS -->
        <script src="{{ asset('public/assets/global/log-js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('public/assets/global/log-js/jquery-ui.min.js')}}"></script>
        <script src="{{ asset('public/assets/global/log-js/selectize.min.js')}}"></script>
        <script src="{{ asset('public/assets/global/log-js/scripts.js')}}"></script>

    </body>

</html>
