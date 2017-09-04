
@extends(FEI.'.master')
@section('content')
<div class="container-fluid">
<div class="row">
<img src="{{ URL::to('public/assets/Frontend/img/AddCaseImage.png') }}" alt="addcase" class="img-responsive">    
</div>        
</div>    



<section class="addcase">
<div class="container">
<div class="row">
<?php
/*
echo "<pre>";

 print_r($cases_data);
 echo "</pre>";
 return;*/
 ?>
 {!! Form::model($cases_data,['method'=>'post','files'=>true,'url'=>'/update-case/'.$id]) !!}



<div class="col-md-4 maa">


<div class="casere-servation">    

<div class="form-group inp1"> 
<label> نوع القضية </label>
<select name="type">
<option value="0">أختار نوع قضيتك</option>
<option value="جنائية">جنائية</option>
<option value="زوجية">زوجية </option>
<option value="أسرية "> أسرية  </option>
</select>
</div> 


<div class="form-group inp2"> 
<label> البلد والمدينة </label>
<select class="sl-cou" name="country">
<option value="0">   اختار البلد </option>
<option value="مصر">مصر </option>
<option value="السعودية">السعودية  </option>
<option value="الامارات"> الامارات  </option>
</select>
<!--<select>
<option value="">   اختار المدينة </option>
<option value="">القاهرة  </option>
<option value="">الجيزة  </option>
<option value=""> اسكندرية  </option>
</select>-->     
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
{!! Form::text('title',old('title'), array('id'=>'title', 'class'=>'form-control','required'=>'required')) !!}


</div>   

<div class="form-group inp-details">     
<label>التفاصيل </label>  
 {!! Form::textarea('description',old('description'), array('rows'=>11,'cols'=>93, 'class'=>'form-control non-resizable') ) !!}

</div> 



</div>    
</div> 
 {!! Form::close() !!}  


</div> 
<hr>    
   
</div> 
</section>  
@stop