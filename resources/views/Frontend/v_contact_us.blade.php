@extends(FEI.'.master')
@section('content')

<section class="contact">

<div class="contact-img"> 
<p> اتصل بنا  </p>    
</div>

<div class="container">

<h3> اذا كان لديك مشكلة فلا تتردد ف مراسالتنااذا كان لديك مشكلة فلا تتردد ف مراسالتنااذا كان لديك مشكلة فلا تتردد ف مراسالتنااذا كان لديك مشكلة فلا تتردد ف مراسالتنا </h3>    

<span class="leave-msg">  اترك لنا رسالة  </span>    

<div class="col-md-9 col-xs-12 pull-right">  

<form action=""  method="get" > 

<div class="row">
<div class="col-md-6 col-xs-12 pull-right">
<div class="form-group">
<label for="txt">الاسم </label>
<input type="text" class="form-control" id="txt">
</div>  
</div> 

<div class="col-md-6 col-xs-12">
<div class="form-group">
<label for="email">البريد الالكترونى </label>
<input type="email" class="form-control" id="email">
</div>
</div>
</div>       

<div class="row">    
<div class="col-md-12">
<div class="form-group">
<label for="addres"> العنوان  </label>
<input type="text" class="form-control" id="addres">
</div>
</div>
</div>

<div class="row">    
<div class="col-md-12">
<div class="form-group">
<label> الرسالة  </label>
<textarea></textarea>
</div>
</div>    
</div>

<button type="submit"> ارسال </button>    

</form>    
</div>   

 
<div class="col-md-3 col-xs-12 ">
<div class="emailadd">   
<h4> البريد الالكترونى </h4>   
<span>contact@mohamyonline.com</span>       
</div>    
</div>    




</div>        




</section>

@stop

