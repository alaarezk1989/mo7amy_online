@extends(FEI.'.master')
@section('content')
      <!--*******************************************************************-->
  <div class="lawyers-img">
       <p>   نتيجة بحثك تكون <b> {{ $query }} </b></p>
      </div> 


<!--***********************************************************************-->

<section class="lawyers">
<div class="container">
<div class="row">

<div class="col-md-12">

 


<input type='hidden' id='current_page' />
<input type='hidden' id='show_per_page' />	    

<div id='content'>

@if(isset($details))
       

@foreach($details as $value)

<div class="col-md-3 col-xs-6 text-center">
<a href="{{lang_url('lawyer').'/'.$value->id}}">    
<div class="pro">    
<img src="{{ asset('public/uploads')}}/avater.png" class="img-responsive">
<h3> {{$value->name}}</h3>    
<p>{{$value->career}} </p>    
</div>   
</a>    
</div>     
@endforeach 
@elseif(isset($message))
         <p>{{ $message }}</p>
         @endif 

</div>	    
</div>    

<!--***********************************************-->    




</div>    
</div>    
</section>

<div id='page_navigation'></div>	




@stop 


<!--*******************************************-->    