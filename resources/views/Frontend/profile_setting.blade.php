@extends(FEI.'.master')
@section('content')


<div class="container-fluid">
   <div class="row">
      <img src="{{ asset('public/assets/'.FE .'/img/Lawyer%20Settings%20Page%20Image.png')}}" class="img-responsive">
   </div>
</div>
<section class="seetings">
   <div class="container">
      <div class="row">
         <div class="col-md-8">
            <div class="tabs-content3">
               <div class="tab1">
                 {!! Form::model($admin_data,['method'=>'post','files'=>true,'url'=>'/update-profile/'.$sess_user_id]) !!}

                     <div class="row">
                        <div class="col-md-6">
                           <label for="basic-url" class="mb"> {{trans('cpanel.career')}} </label>
                             {!! Form::text('career',old('career'), array('id'=>'career', 'class'=>'form-control')) !!}
                        </div>
                        <div class="col-md-6">
                           <label for="basic-url" class="mb"> {{trans('cpanel.name')}} </label>
                              {!! Form::text('name',old('name'), array('id'=>'name', 'class'=>'form-control','required'=>'required')) !!}
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12">
                           <label for="basic-url" class="mb">{{trans('cpanel.description')}} </label>

                             {!! Form::textarea('short_description',old('short_description'), array('rows'=>5,'cols'=>10, 'class'=>'form-control non-resizable') ) !!}
                        </div>
                     </div>

                     <div class="row">



                        <div class="col-md-4">
                           <div class="form-group">
                              <label class="mb"> {{trans('cpanel.city')}}  </label>
                              {!! Form::select('city', $states,old('city'), ['id'=>'city','class' => 'sl-cou']) !!}
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="form-group">
                              <label class="mb"> {{trans('cpanel.country')}}  </label>
                              {!! Form::select('country', $countries,old('country'), ['id'=>'country','class' => 'sl-cou']) !!}

                           </div>
                        </div>


                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="basic-url" class="mb">{{trans('cpanel.birthdate')}} </label>

                              {{ Form::text('birthdate',old('birthdate'), array('id' => 'datepicker','class' => 'form-control')) }}
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-6 ">
                           <span class="gen mb">{{ trans('cpanel.gender')}} </span>
                           <label class="circle-label one">
                           {!! Form::radio('gender', 'male','true') !!}
                           <span class="place-name" id="male"> {{ trans('cpanel.male') }} </span>
                           </label>
                           <label class="circle-label">
                              {!! Form::radio('gender', 'female','true') !!}
                           <span class="place-name" id="female"> {{ trans('cpanel.female') }}  </span>
                           </label>
                        </div>
                        <div class="col-md-6">
                           <label for="basic-url" class="mb">  {{trans('cpanel.phone_number')}} </label>
                             {!! Form::tel('phone',old('phone'), array('id'=>'phone', 'class'=>'form-control','required'=>'required','placeholder'=>trans('cpanel.phone_number'))) !!}
                        </div>
                     </div>


                     <div class="row">
                        <div class="col-md-6 ">
                          @if($admin_data->image !='')
                            <img src="{{ asset('public/uploads/user_img')}}/{{$admin_data->image}}" class="img-responsive" />
                          @else
                            <img src="{{ asset('public/uploads')}}/avater.png" class="img-responsive"/>
                          @endif
                        </div>
                        <div class="col-md-6">
                           <label for="u_image" class="mb">  {{trans('cpanel.user_image')}} </label>
                             {!! Form::file('profile_picture',null) !!}
                        </div>
                     </div>


                     @if($admin_data->permissions=='lawyer')
                    <div class="row">
                      @foreach($specialty as $key=>$value)
                       <div class="col-md-2 col-xs-4">
                          <label class="circle-label one">
                            @if (in_array($key, $user_specialty))
                              {!! Form::checkbox('specialty[]',$key, true, array('id' => 'ttt') ) !!}
                            @else
                              {!! Form::checkbox('specialty[]',$key, null, array('id' => 'ttt') ) !!}
                            @endif
                          <span class="place-name spec" id="{{$key}}"> {{$value}}  </span>
                          </label>
                       </div>
                     @endforeach

                    </div>
                    @endif

                     <div class="buttons-save">
                        <button class="done" type="submit">  {{ trans('cpanel.save') }} </button>
                        <button type="reset" class="delet">  {{ trans('cpanel.cancel') }} </button>
                     </div>
                 {!! Form::close() !!}
               </div>
               <div class="tab2">
                 {!! Form::model($admin_data,['method'=>'post','url'=>'/change-password/'.$admin_data->id]) !!}
                     <div class="row">
                        <div class="col-md-12">
                           <label for="basic-url" class="mb">  كلمة السر القديمة </label>
                        {!! Form::password('current_password', array('id'=>'current_password', 'class'=>'form-control','required'=>'required')) !!}
                        </div>
                        <div class="col-md-12">
                           <label for="basic-url" class="mb">كلمة السر الجديدة  </label>
                            {!! Form::password('new_password', array('id'=>'new_password', 'class'=>'form-control','required'=>'required')) !!}
                        </div>
                        <div class="col-md-12">
                           <label for="basic-url" class="mb">    تأكيد كلمة السر </label>
                           {!! Form::password('password_confirmation', array('id'=>'password_confirmation', 'class'=>'form-control','required'=>'required')) !!}
                        </div>
                        <div class="col-md-12">
                           <div class="pass-buttons">
                              <button class="saveme" type="submit">حفظ </button>
                              <button class="cancelme">الغاء </button>
                           </div>
                        </div>
                     </div>
                 {!! Form::close() !!}
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <ul class="list-tabs3 list-unstyled">
               <li class="selected custom-jss" data-class="tab1">  البيانات الاساسية </li>
               <li data-class="tab2"> كلمة السر </li>
            </ul>
         </div>
      </div>
   </div>
</section>

@stop
