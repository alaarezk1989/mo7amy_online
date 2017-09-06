
@extends(FEI.'.master')
@section('content')
<div class="container-fluid">
<div class="row">
<img src="{{ URL::to('public/assets/Frontend/img/Add%20Case%20Image.png') }}" alt="addcase" class="img-responsive">    
</div>        
</div>    



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
<label> نوع القضية </label>

{!! Form::select('type', $specialty,old('type'), ['id'=>'type']) !!}
</div> 


<div class="form-group inp2"> 
<label> البلد والمدينة </label>


 {!! Form::select('country', $countries,old('country'), ['id'=>'country','class' => 'sl-cou']) !!}


 {!! Form::select('city', $states,old('city'), ['id'=>'city','class' => 'sl-cou']) !!}
                            
</div>    


<div class="form-group inp3"> 
<label> تاريخ الانتهاء </label>    
 
{!! Form::date('finished_date',old('finished_date'), array('id'=>'finished_date', 'class'=>'form-control','placeholder'=>'اختار التاريخ')) !!}
 
</div> 


<button type="submit"> اضف قضيتك </button>   

</div>    

</div>    


<div class="col-md-8 maa">


    @if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

@if ($errors->has('title'))
<div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('title') }}</div>                                 
@endif

 @if ($errors->has('description'))
<div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('description') }}</div>                                   
 @endif

 @if ($errors->has('type'))
<div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('type') }}</div>                                   
 @endif

  @if ($errors->has('country'))
<div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('country') }}</div>                                   
 @endif

  @if ($errors->has('city'))
<div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('city') }}</div>                                   
 @endif


<div class="casedetails">

<div class="form-group inp-addcase"> 
<label> عنوان القضية </label>

{!! Form::text('title',old('title'), array('id'=>'title', 'class'=>'form-control','placeholder'=>'أضف عنوان لقضيتك')) !!}




</div>   

<div class="form-group inp-details">     
<label>التفاصيل </label>  

{!! Form::textarea('description',old('description'), array('id'=>'description','rows'=>'11','cols'=>'93', 'class'=>'form-control','placeholder'=>'أضف تفاصيل قضيتك')) !!}
 
</div> 



</div>    
</div> 
 {!! Form::close() !!}  


</div> 
<hr>    
   
</div> 
</section>  
@stop