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
	    @if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif


@if ($errors->has('name'))
<div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('name') }}</div>
@endif

@if ($errors->has('email'))
<div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('email') }}</div>
@endif


@if ($errors->has('address'))
<div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('address') }}</div>
@endif

@if ($errors->has('message'))
<div class="alert alert-danger" style="font-size: 15px;" role="alert">{{ $errors->first('message') }}</div>
@endif

{!! Form::open(['method'=>'POST','url'=>'store']) !!} 

<div class="row">
<div class="col-md-6 col-xs-12 pull-right">
<div class="form-group">
<label for="txt">الاسم </label>
{!! Form::text('name',old('name'), array('id'=>'txt', 'class'=>'form-control')) !!}


</div>  
</div> 

<div class="col-md-6 col-xs-12">
<div class="form-group">
<label for="email">البريد الالكترونى </label>
{!! Form::text('email',old('email'), array('id'=>'email', 'class'=>'form-control')) !!}
</div>
</div>
</div>       

<div class="row">    
<div class="col-md-12">
<div class="form-group">
<label for="addres"> العنوان  </label>
{!! Form::text('address',old('address'), array('id'=>'addres', 'class'=>'form-control')) !!}
</div>
</div>
</div>

<div class="row">    
<div class="col-md-12">
<div class="form-group">
{!! Form::textarea('message',old('message'), array('id'=>'addres', 'class'=>'form-control')) !!}

</div>
</div>    
</div>

<button type="submit"> ارسال </button>    
 {!! Form::close() !!} 
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

