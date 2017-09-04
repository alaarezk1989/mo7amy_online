@extends(ADI.'.master')
@section('content')
<link href="{{ asset('public/assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
<script type="text/javascript">
  $(document).ready(function(){
    $(".change_password_link").click(function(){
      $(".change_password_div").hide();
      $("#password").attr("required","required");
      $("#password_confirmation").attr("required","required");
      $(".change_password").removeClass('hidden');
    });
  });
</script>

@if($errors->has('password') || $errors->has('password_confirmation'))
<script type="text/javascript">
  $(document).ready(function(){
    $(".change_password_div").hide();
    $(".change_password").removeClass('hidden');
  });
</script>
@endif

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">{{$form_title}}</span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                @if(!empty($admin_data))
			        {!! Form::model($admin_data,['method'=>'PATCH','url'=>'/admins/'.$admin_data->id, 'id'=>'form_sample_3']) !!}
			        @else
			          {!! Form::open(['method'=>'POST','id'=>'form_sample_3','action'=>'Administrator\AdminController@store']) !!}
			    @endif

                    <div class="form-body">
                        <div class="form-group">
                        	<label for="name" class="col-md-3 control-label">
                        		 name  <span class="required"> * </span>
                            </label>

                            <div class="col-md-6">
                            	<div class="input-group">
                            		<span class="input-group-addon">
	                                    <i class="fa fa-user"></i>
	                                </span>
					            	{!! Form::text('name',old('name'), array('id'=>'name', 'class'=>'form-control','required'=>'required','placeholder'=>'name')) !!}
                            	</div>
                            	@if($errors->has('name'))
						          <span class="help-block text-danger">{{ $errors->first('name') }}</span>
						        @endif
					        </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-3 control-label">
                            	 email_address <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    {!! Form::text('email',old('email'), array('id'=>'email', 'class'=>'form-control','required'=>'required','placeholder'=>'email_address')) !!}
                                </div>
                                @if($errors->has('email'))
						          <span class="help-block text-danger">{{ $errors->first('email') }}</span>
						        @endif
                            </div>
                        </div>

                        @if(!empty($admin_data))
						    <div class="form-group change_password_div">
						        <label  class="col-md-3 control-label">change_password
						        </label>
						        <div class="col-md-6">
						          <a class="btn btn-primary change_password_link" >change_password</a>
						        </div>
						    </div>

					      	<div class="form-group hidden change_password">
	                            <label for="password" class="col-md-3 control-label">
	                            	password  <span class="required"> * </span>
	                            </label>
	                            <div class="col-md-6">
	                                <div class="input-group">
	                                    <span class="input-group-addon">
	                                        <i class="fa fa-lock"></i>
	                                    </span>
	                                    {!! Form::password('password', array('id'=>'password', 'class'=>'form-control','placeholder'=>'password')) !!}
	                                </div>
	                                @if($errors->has('password'))
							          <span class="help-block text-danger">{{ $errors->first('password') }}</span>
							        @endif
	                            </div>
	                        </div>

	                        <div class="form-group hidden change_password">
	                            <label for="password_confirmation" class="col-md-3 control-label">
	                            	password_confirmation  <span class="required"> * </span>
	                            </label>
	                            <div class="col-md-6">
	                                <div class="input-group">
	                                    <span class="input-group-addon">
	                                        <i class="fa fa-lock"></i>
	                                    </span>
	                                    {!! Form::password('password_confirmation', array('id'=>'password_confirmation', 'class'=>'form-control','placeholder'=>'password_confirmation')) !!}
	                                </div>
	                                @if($errors->has('password_confirmation'))
							          <span class="help-block text-danger">{{ $errors->first('password_confirmation') }}</span>
							        @endif
	                            </div>
	                        </div>

					      @else
						    <div class="form-group">
	                            <label for="password" class="col-md-3 control-label">
	                            	 password  <span class="required"> * </span>
	                            </label>
	                            <div class="col-md-6">
	                                <div class="input-group">
	                                    <span class="input-group-addon">
	                                        <i class="fa fa-lock"></i>
	                                    </span>
	                                    {!! Form::password('password', array('id'=>'password', 'class'=>'form-control','required'=>'required','placeholder'=>'password')) !!}
	                                </div>
	                                @if($errors->has('password'))
							          <span class="help-block text-danger">{{ $errors->first('password') }}</span>
							        @endif
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label for="password_confirmation" class="col-md-3 control-label">
	                            	 password_confirmation  <span class="required"> * </span>
	                            </label>
	                            <div class="col-md-6">
	                                <div class="input-group">
	                                    <span class="input-group-addon">
	                                        <i class="fa fa-lock"></i>
	                                    </span>
	                                    {!! Form::password('password_confirmation', array('id'=>'password_confirmation', 'class'=>'form-control','required'=>'required','placeholder'=>'password_confirmation')) !!}
	                                </div>
	                                @if($errors->has('password_confirmation'))
							          <span class="help-block text-danger">{{ $errors->first('password_confirmation') }}</span>
							        @endif
	                            </div>
	                        </div>
					    @endif

                        @if(!empty($admin_data) && auth()->user()->id != $admin_data->id)
					      <div class="form-group">
					        {!! Form::label('status_admin', status, array('class'=>'control-label col-md-3')) !!}
					        <div class="col-md-6">
					            <div class="mt-radio-list">
					              <label class="mt-radio">
					                {!! Form::radio('status', '1','true',array('class'=>'input_status_admin')) !!}
					                {{ on }}
					                <span></span>
					              </label>
					              <label class="mt-radio">
					                {!! Form::radio('status', '0','',array('class'=>'input_status_admin')) !!}
					                {{ off }}
					                <span></span>
					              </label>
					            </div>
					            @if($errors->has('status'))
						          <span class="help-block text-danger">{{ $errors->first('status') }}</span>
						        @endif
					        </div>
					      </div>
					      @elseif($type==='add')
					      <div class="form-group">
					        {!! Form::label('status_admin', 'status', array('class'=>'control-label col-md-3')) !!}
					        <div class="col-md-6">
					            <div class="mt-radio-inline">
					              <label class="mt-radio">
					                {!! Form::radio('status', '1','true',array('class'=>'input_status_admin')) !!}
					                 on
					                <span></span>
					              </label>
					              <label class="mt-radio">
					                {!! Form::radio('status', '0','',array('class'=>'input_status_admin')) !!}
					                off
					                <span></span>
					              </label>
					            </div>
					            @if($errors->has('status'))
						          <span class="help-block text-danger">{{ $errors->first('status') }}</span>
						        @endif
					        </div>
					      </div>
					    @endif


                        <div class="form-group">
		                  {!! Form::label('permissions', 'admin_type', array('class'=>'control-label col-md-3')) !!}
		                  <div class="col-md-6">

			                  {!! Form::select('permissions', $types, null, ['class' => 'form-control select2me']) !!}

			                  @if($errors->has('permissions'))
						        <span class="help-block text-danger">{{ $errors->first('permissions') }}</span>
						      @endif
		                  </div>
		                </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                            	{!! Form::submit($submit_button, array('class'=>'btn green')) !!}
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
                <!-- END FORM-->
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
</div>

@stop
