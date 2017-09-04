<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
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
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="{{ asset('public/assets/'.AD .'/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />


        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->

        <script src="{{ asset('public/assets/'.AD .'/global/log-js/jquery-3.2.1.min.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.AD .'/global/log-css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.AD .'/global/log-css/selectize.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.AD .'/global/log-css/bootstrap-datepicker.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.AD .'/global/log-css/jquery.mCustomScrollbar.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.AD .'/global/plugins/summernote-img/css/font-awesome.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.AD .'/global/plugins/summernote-img/css/summernote.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/'.AD .'/global/log-css/styles.css')}}">
        <!--[if lt IE 9]>
			<script src="{{ asset('public/assets/'.AD .'/global/log-js/html5shiv.min.js')}}"></script>
			<script src="{{ asset('public/assets/'.AD .'/global/log-js/respond.min.js')}}"></script>
		<![endif]-->

        <!-- ckeditor -->
        <!-- <script src="{{ asset('public/assets/'.AD .'/global/plugins/ckeditor/ckeditor.js')}}"></script>
        <script src="{{ asset('public/assets/'.AD .'/global/plugins/ckeditor/config.js')}}"></script> -->


        <!-- <link href="{{ asset('public/assets/'.AD .'/global/plugins/bootstrap-summernote/summernote.css')}}" rel="stylesheet" type="text/css" /> -->

        <!-- <link href="{{ asset('public/assets/'.AD .'/global/plugins/summernote/summernote.css')}}" rel="stylesheet" type="text/css" />


        <script src="{{ asset('public/assets/'.AD .'/global/plugins/summernote/summernote.js')}}"></script> -->

        <!-- <link href="{{ asset('public/assets/'.AD .'/global/plugins/summernote-img/css/bootstrap.css')}}" rel="stylesheet"> -->

        <!-- End Shift CSS -->

        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{ asset('public/assets/'.AD .'/global/css/lightbox.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/'.AD .'/global/log-css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- file upload -->
        <link href="{{ asset('public/assets/'.AD .'/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/'.AD .'/global/plugins/jquery-file-upload/css/jquery.fileupload.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/'.AD .'/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css')}}" rel="stylesheet" type="text/css" />

        <!-- <link href="{{ asset('public/assets/'.AD .'/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" /> -->

        <!-- <link href="{{ asset('public/assets/'.AD .'/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" /> -->

        <!-- <link href="{{ asset('public/assets/'.AD .'/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" /> -->

        <!-- <link href="{{ asset('public/assets/'.AD .'/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" /> -->

        <link href="{{ asset('public/assets/'.AD .'/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- <link href="{{ asset('public/assets/'.AD .'/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" /> -->

        <!-- <link href="{{ asset('public/assets/'.AD .'/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" /> -->

        <!-- <link href="{{ asset('public/assets/'.AD .'/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" /> -->

        <!-- <link href="{{ asset('public/assets/'.AD .'/global/plugins/clockface/css/clockface.css')}}" rel="stylesheet" type="text/css" /> -->

        <!-- Datatables -->
        <!-- <link href="{{ asset('public/assets/'.AD .'/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/'.AD .'/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" /> -->

        <!-- nestable -->
        <!-- <link href="{{ asset('public/assets/'.AD .'/global/plugins/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet" type="text/css" /> -->
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL STYLES -->
        <!-- <link href="{{ asset('public/assets/'.AD .'/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" /> -->

        <!-- <link href="{{ asset('public/assets/'.AD .'/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" /> -->
        <!-- END THEME GLOBAL STYLES -->


        <link rel="shortcut icon" href="{{ asset('public/assets/'.AD .'/global/img/favicon.ico')}}" />
    </head>
    <!-- END HEAD -->
    <body>
      @if(auth()->user()->permissions == 'admin')
        <main class="has-sidemenu">
          @include(ADI.'.aside')
          <div class="page-wrapper">
          @include(ADI.'.menu')
      @else
       <main>
        @include(ADI.'.aside')
        <div class="page-wrapper">
      @endif
