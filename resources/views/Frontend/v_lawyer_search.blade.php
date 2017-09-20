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

  <div class="arrange">
                     <i class="fa fa-sort " aria-hidden="true"></i>
                     <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        {{ trans('cpanel.arranging') }}
                        <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu arrang-menu" aria-labelledby="dropdownMenu1">
                           <li><a href="#">{{ trans('cpanel.highest_price') }}</a></li>
                           <li><a href="#">{{ trans('cpanel.lowest_price') }}</a></li>
                           <li><a href="#">{{ trans('cpanel.latest_show') }} </a></li>
                        </ul>
                     </div>
                     <p>
                       {{trans('cpanel.show')}}
                        <span> 0- {{ $details->perPage() }} </span>
                        {{trans('cpanel.of')}}
                        <span> {{$details->total()}} </span>{{trans('cpanel.result')}}
                     </p>
                     <div id='page_navigation'>{{ $details->links() }}</div>
                  </div>



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