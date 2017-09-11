

<!DOCTYPE html>
<html lang="ar">
   <head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="keywords" content="">
      <title>
          @if(!empty($title))
              {{$title}}
              @if(!empty($page_title))
              | {{$page_title}}
              @endif
          @endif
      </title>

      <link href="{{ asset('public/assets/'.FE .'/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{ asset('public/assets/'.FE .'/css/font-awesome.min.css')}}" rel="stylesheet">
      <link href="{{ asset('public/assets/'.FE .'/css/hover-min.css')}}" rel="stylesheet">
      <link href="{{ asset('public/assets/'.FE .'/css/index-ar.css')}}" rel="stylesheet">
      <link href="{{ asset('public/assets/'.FE .'/css/jquery-ui.css')}}" rel="stylesheet">
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>

   <?php
     $url_segment = \Request::segment(1);
     if($url_segment=='ar' || $url_segment=='en'){
       App::setLocale($url_segment);
       $locale = App::getLocale();
     }else{
       App::setLocale('ar');
       $locale = App::getLocale();
     }

     session(['sess_locale' => $locale]);
     $sess_locale= session('sess_locale');
    //  if(auth()->user()){
       $sess_user_id= session('user_id');

    //  }

//echo $sess_user_id;
//houida
//houida
//houida
//houida
//houida
//houida
//houida
//houida
//houida
//houida
?>

   <body>
      <nav class="navbar navbar-default " role="navigation">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="{{url($locale)}}">
               <img src="{{ asset('public/assets/'.FE .'/img/Logo.png')}}" alt="logo" class="img-responsive logo"></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               @include(FEI.'.menu')

               <ul class="nav navbar-nav navbar-left ">
                 @if(!auth()->user())
                  <li class="dropdown">
                     <a class="dropdown-toggle menu">  {{ trans('cpanel.login') }}
                     <img src="{{ asset('public/assets/'.FE .'/img/Vector%20Smart%20Object.png')}}" class="sign">
                     </a>

                     <ul id="login-dp" class="dropdown-menu sign-form login-dp">
                        <li>
                           <div class="row">
                             @if(Session::has('error_msg'))
                               <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('error_msg') }}</p>
                             @endif
                             @if(Session::has('success_msg'))
                               <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success_msg') }}</p>
                             @endif
                            {!! Form::open(['method'=>'POST', 'class'=>'form','id'=>'register-nav','url'=>'register','role'=>'form',' accept-charset'=>'UTF-8']) !!}
                              <div class="col-md-12">
                                 <p class="acc-tybe"> {{ trans('cpanel.account_type') }}</p>
                                    <div class="form-group text-center">
                                       <label class="circle-label one">

                                       {!! Form::radio('permissions', 'lawyer','',array('checked'=>'checked')) !!}
                                       <span class="place-name" id="lawyer"> {{trans('cpanel.lawyer')}}  </span>
                                       </label>
                                       <label class="circle-label">
                                      {!! Form::radio('permissions', 'client') !!}
                                       <span class="place-name" id="client"> {{ trans('cpanel.client') }}   </span>
                                       </label>

                                       @if($errors->has('permissions'))
                   						          <span class="help-block text-danger">{{ $errors->first('permissions') }}</span>
                   						        @endif
                                    </div>

                                    <div class="form-group">
                                       {!! Form::text('name',old('name'), array('id'=>'name', 'class'=>'form-control','required'=>'required','placeholder'=>trans('cpanel.name'))) !!}
                                       @if($errors->has('name'))
                   						          <span class="help-block text-danger">{{ $errors->first('name') }}</span>
                   						        @endif
                                    </div>

                                    <div class="form-group">
                                      {!! Form::tel('phone',old('phone'), array('id'=>'phone', 'class'=>'form-control','required'=>'required','placeholder'=>trans('cpanel.phone_number'))) !!}
                                      @if($errors->has('phone'))
                                        <span class="help-block text-danger">{{ $errors->first('phone') }}</span>
                                      @endif
                                    </div>

                                    <div class="form-group">
                                         {!! Form::email('email',old('email'), array('id'=>'email', 'class'=>'form-control','required'=>'required','placeholder'=>trans('cpanel.email_address'))) !!}
                                         @if($errors->has('email'))
                                           <span class="help-block text-danger">{{ $errors->first('email') }}</span>
                                         @endif
                                    </div>

                                    <div class="form-group">
                                         {!! Form::password('password', array('id'=>'password', 'class'=>'form-control','placeholder'=>trans('cpanel.enter_password'))) !!}
                                         @if($errors->has('password'))
                                          <span class="help-block text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                       {!! Form::password('password_confirmation', array('id'=>'password_confirmation', 'class'=>'form-control','placeholder'=>trans('cpanel.confirm_password'))) !!}
                                       @if($errors->has('password_confirmation'))
                 							          <span class="help-block text-danger">{{ $errors->first('password_confirmation') }}</span>
                 							        @endif
                                    </div>

                                    <div class=" slct form-group">
                                      {!! Form::select('country', get_countries_cities()['countries'],'', array('id'=>'country') ) !!}

                                      {!! Form::select('city', get_countries_cities()['states'],'', array('id'=>'city')) !!}

                                    </div>
                                    <div class="gender text-center">
                                       <span class="gen mb text-center">{{ trans('cpanel.gender')}} </span>
                                       <label class="circle-label one">
                                       {!! Form::radio('gender', 'male','true') !!}
                                       <span class="place-name" id="male"> {{ trans('cpanel.male') }} </span>
                                       </label>
                                       <label class="circle-label">
                                       {!! Form::radio('gender', 'female','true') !!}
                                       <span class="place-name" id="female"> {{ trans('cpanel.female') }}</span>
                                       </label>
                                    </div>
                                      {!! Form::hidden('status',1) !!}
                                    <div class="buttons">
                                       <button type="submit" class="">  {{ trans('cpanel.register') }}  </button>
                                       <button class="already-mem">  {{ trans('cpanel.have_account') }}   </button>
                                    </div>
                                    <hr class="or">
                                    <span class="span_Or"> {{ trans('cpanel.or') }} </span>
                                    <a href="#" class="btn btn-fb btn-block">
                                      <i class="fa fa-facebook"></i> {{ trans('cpanel.signin_using_facebook') }}</a>

                              </div>
                               {!! Form::close() !!}
                           </div>
                        </li>
                     </ul>
                     <!--********************************************************-->
                     <ul id="login-dp" class="dropdown-menu login-form login-dp">
                        <li>
                           <div class="row">
                              <div class="col-md-12">
                                @if(Session::has('error_login'))
                                  <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('error_login') }}</p>
                                @endif
                                 <p class="acc-tybe"> {{ trans('cpanel.account_type') }}</p>

                                   {!! Form::open(['url'=>$sess_locale.'/login', 'class'=>'form','id'=>'login-nav','role'=>'form',' accept-charset'=>'UTF-8']) !!}
                                    <div class="form-group tooltip">
                                      <?php $error_class=''; ?>
                                      @if($errors->has('email'))
                                        <?php $error_class='error'; ?>
                                        <span class="tooltiptext">{{ $errors->first('email') }}</span>
                                      @endif
                                         {!! Form::email('email', old('email'), array('class'=>'form-control '.$error_class,'placeholder'=>trans('cpanel.email_address'), 'id' => 'exampleInputEmail2')) !!}

                                    </div>
                                    <div class="form-group tooltip">
                                        <?php $error_class=''; ?>
                                        @if($errors->has('password'))
                                            <?php $error_class='error'; ?>
                                         <span class="tooltiptext">{{ $errors->first('password') }}</span>
                                       @endif
                                         {!! Form::password('password', array('class'=>'form-control '.$error_class,'placeholder'=>trans('cpanel.enter_password'), 'id' => 'exampleInputPassword2')) !!}

                                    </div>
                                    <a href="#" class="forgetpass"> {{ trans('cpanel.forgot_password') }} </a>
                                    <div class="buttons form-group">
                                       <button type="submit" class="">  {{ trans('cpanel.login') }}   </button>
                                       <button type="button" class="register"> {{ trans('cpanel.signin') }} </button>
                                    </div>
                                    <hr class="or">
                                    <span class="span_Orr"> {{ trans('cpanel.or') }} </span>
                                    <a href="#" class="btn btn-fb btn-block">
                                      <i class="fa fa-facebook"></i> {{ trans('cpanel.signin_using_facebook') }}</a>
                                {!! Form::close() !!}
                              </div>
                           </div>
                        </li>
                     </ul>
                     <ul id="login-dp" class="dropdown-menu forget login-dp">
                        <li>
                           <div class="row">
                              <div class="col-md-12">
                                 <p class="long-parag"> {{ trans('cpanel.forgot_password_msg') }}   </p>


                                 {!! Form::open(['method'=>'POST', 'class'=>'form','id'=>'login-nav','url'=>'password/email','role'=>'form',' accept-charset'=>'UTF-8']) !!}
                                    <div class="form-group tooltip">
                                        <?php $error_class=''; ?>
                                      @if($errors->has('email'))
                                          <?php $error_class='error'; ?>
                                        <span class="tooltiptext">{{ $errors->first('email') }}</span>
                                      @endif
                                       {!! Form::email('email','', array('id'=>'email', 'class'=>'form-control '.$error_class,'required'=>'required','placeholder'=>trans('cpanel.email_address'))) !!}

                                    </div>
                                    <div class="butn-send form-group">
                                       <button type="submit" class="send">  {{ trans('cpanel.submit') }}    </button>
                                    </div>
                                  {!! Form::close() !!}
                              </div>
                           </div>
                        </li>
                     </ul>
                  </li>
                  @else
                  <ul class="nav navbar-nav navbar-left">
                  <li class="dropdown">
                    <a href="#" class="lk-profile">
                      @if(user_auth()->image !='')
                        <img src="{{ asset('public/uploads/user_img')}}/{{user_auth()->image}}" alt="account" class="img-acc">
                      @else
                        <img src="{{ asset('public/uploads')}}/avater.png" class="img-responsive"/>
                      @endif
                    </a>
                     <a href="#" class="dropdown-toggle prof-name" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <span class=""> {{user_auth()->name}} </span><span class="caret"></span></a>
                      <ul class="dropdown-menu user-menu">
                        <li> <a href="{{lang_url('create')}}"> اضف قضية </a></li>
                        <li> <a href="{{lang_url('your-cases')}}"> قضاياك </a></li>
                        <li> <a href="{{lang_url('edit-profile').'/'.$sess_user_id}}">{{ trans('cpanel.my_profile') }} </a></li>
                        <li> <a href="client-setting.html">  اعداداتى </a></li>
                        <li> <a href="{{lang_url('logout')}}">  {{ trans('cpanel.log_out') }} </a></li>
                      </ul>
                  </li>

                  @endif
               </ul>
            </div>
            <!-- /.navbar-collapse -->
         </div>
         <!-- /.container-fluid -->
      </nav>
