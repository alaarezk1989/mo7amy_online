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
        <link rel="shortcut icon" href="{{ asset('public/assets/global/img/favicon.ico')}}" /> </head>
    <!-- END HEAD -->
    <!-- BEGIN LOGIN THEME LAYOUT STYLES -->
    <link href="{{ asset('public/assets/global/log-css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/global/log-css/styles.css')}}" rel="stylesheet" type="text/css" id="style_color" />
    <!-- END LOGIN THEME LAYOUT STYLES -->

    <body>
        <section id="login">
            <h1 id="logo">
                <a href="">Smart Money</a>
            </h1>
            <div class="form-container">

                <img src="{{ asset('public/assets/global/images/lock.svg')}}">
                <h3>{{ trans('cpanel.forgot_password') }}</h3>
                {!! Form::open(['url'=>'password/email', 'class'=>'login-form']) !!}

                @if(Session::has('not_user'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span>{{ session()->get('not_user') }}</span>
                </div>
                @endif

                <div class="form-group">
                    {!! Form::email('email', old('email'), array('class'=>'form-control form-control-solid placeholder-no-fix','placeholder'=>trans('cpanel.enter_email'), 'id' => 'loginEmailInput')) !!}
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong style='color: red;'>{{ $errors->first('email') }}</strong>
                    </span>
                    @else
                    <span class="input-info">{{ trans('cpanel.write_correct_mail')}}</span>
                    @endif
                </div>


                {!! Form::submit(trans('cpanel.send'), array('class'=>'btn btn-primary btn-icon-right')) !!}
                {!! Form::close() !!}
            </div>
            <span class="copyrights">&copy; {{ trans('cpanel.copyright')}}</span>
        </section>

        <!-- BEGIN LOGIN SCRIPTS -->
        <script src="{{ asset('public/assets/global/log-js/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('public/assets/global/log-js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('public/assets/global/log-js/scripts.js')}}" type="text/javascript"></script>
    </body>

</html>
