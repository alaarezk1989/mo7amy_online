
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
                    {!! Form::model($cases_data,['method'=>'PATCH','url'=>'/update-case/'.$cases_data->id, 'id'=>'form_sample_3']) !!}
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
<input type="date" placeholder="اختار التاريخ" name="finished_date">      
</div> 


<button type="submit"> اضف قضيتك </button>   

</div>    

</div>    


<div class="col-md-8 maa">


	@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif


<div class="casedetails">

<div class="form-group inp-addcase"> 
<label> عنوان القضية </label>

{!! Form::text('title',old('title'), array('id'=>'title', 'class'=>'form-control','required'=>'required','placeholder'=>'أضف عنوان لقضيتك')) !!}

@if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif


</div>   

<div class="form-group inp-details">     
<label>التفاصيل </label>  
<textarea  name ="description" rows="11" cols="93" placeholder="أضف تفاصيل قضيتك "></textarea>    
</div> 



</div>    
</div> 
 {!! Form::close() !!}  


</div> 
<hr>    
   
</div> 
</section>  
@stop