
@extends(FEI.'.master')
@section('content')
 


          @if(!empty($cases_data))
                      <div class="addcase-img">
                         <p>{{trans('cpanel.Edit_Case')}}   </p>
                     </div>  
                    @else
                      <div class="addcase-img">
                         <p>{{trans('cpanel.Add_Case')}}  </p>

                      </div>  
                @endif

<section class="addcase">
<div class="container">
<div class="row">


    <!-- BEGIN FORM-->
                @if(!empty($cases_data))
                    {!! Form::model($cases_data,['method'=>'post','files'=>true,'url'=>'/update-case/'.$id]) !!}
                    @else
                      {!! Form::open(['method'=>'POST','id'=>'form_sample_3','url'=>'create-case']) !!}
                @endif



<div class="col-md-4 maa">

<div class="casere-servation">

<div class="form-group inp1">
<label> {{trans('cpanel.Sections')}} </label>


{!! Form::select('section_id', $sections,old('section_id'), ['id'=>'section_id','class' => 'sl-cou']) !!}

 @if ($errors->has('section_id'))
<div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('section_id') }}</div>
 @endif

</div>


<div class="form-group inp2">
<label> {{trans('cpanel.Country_and_City')}} </label>


 {!! Form::select('country', $countries,$case_country_id, ['id'=>'country','class' => 'sl-cou']) !!}
  @if ($errors->has('country'))
<div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('country') }}</div>
 @endif

 {!! Form::select('city', $states,old('city'), ['id'=>'city','class' => 'sl-cou']) !!}
  @if ($errors->has('city'))
<div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('city') }}</div>
 @endif
</div>


<div class="form-group inp3">
<label> {{trans('cpanel.Finished_date')}}</label>

{!! Form::date('finished_date',old('finished_date'), array('id'=>'finished_date', 'class'=>'form-control','placeholder'=>'اختار التاريخ')) !!}

  @if ($errors->has('finished_date'))
<div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('finished_date') }}</div>
 @endif
</div>

          @if(!empty($cases_data))
                      
                        <button type="submit">{{trans('cpanel.Edit_Case')}}   </button>
                    
                    @else
                 
                     <button type="submit"> {{trans('cpanel.Add_Case')}}  </button>

                   
                @endif



</div>

</div>


<div class="col-md-8 maa">


    @if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif










<div class="casedetails">

<div class="form-group inp-addcase">
<label> {{trans('cpanel.Case_Title')}}</label>

{!! Form::text('title',old('title'), array('id'=>'title', 'class'=>'form-control','placeholder'=>trans('cpanel.Case_Title'))) !!}

@if ($errors->has('title'))
<div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('title') }}</div>
@endif


</div>

<div class="form-group inp-details">
<label>{{trans('cpanel.Details')}} </label>

{!! Form::textarea('description',old('description'), array('id'=>'description','rows'=>'11','cols'=>'93', 'class'=>'form-control','placeholder'=>trans('cpanel.Details_case'))) !!}
 @if ($errors->has('description'))
<div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('description') }}</div>
 @endif
</div>



</div>
</div>
 {!! Form::close() !!}


</div>


</div>
</section>
@stop
