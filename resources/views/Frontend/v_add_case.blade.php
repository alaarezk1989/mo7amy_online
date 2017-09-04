
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

  <form  method="POST" action="{{ url('test') }}">
                        {{ csrf_field() }}


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
<input name="title" type="text" class="form-control" placeholder="أضف عنوان لقضيتك"> 
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
</form>   


</div> 
<hr>    
   
</div> 
</section>  
@stop