


@extends(FEI.'.master')
@section('content')

<?php
use Carbon\Carbon;
$locale = App::getLocale();

?>

<div class="container-fluid">
<div class="row">

<div class="tabs-content margin-top">

<div class="tab1 hidden-xs">
<div id="map"></div>  
</div>

<div class="tab2">  
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
<!-- Indicators -->
<ol class="carousel-indicators">
<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
<li data-target="#carousel-example-generic" data-slide-to="1"></li>
<li data-target="#carousel-example-generic" data-slide-to="2"></li>
</ol>
<div class="carousel-inner" role="listbox">
<div class="item active">
<img src="{{ URL::to('public/assets/Frontend/img/Slider1.jpg') }}" alt="slide1" class="img-responsive">
<div class="carousel-caption d-none d-md-block">
<a href="{{lang_url('create')}}">
<button class="btn-add-case">اضف قضيتك</button></a>
</div>
</div>
<div class="item">
<img src="{{ URL::to('public/assets/Frontend/img/Slider2.jpg') }}" alt="slide2" class="img-responsive">
<div class="carousel-caption d-none d-md-block">
<a href="{{lang_url('create')}}">
<button class="btn-add-case">اضف قضيتك</button></a>
</div>
</div>

<div class="item">
<img src="{{ URL::to('public/assets/Frontend/img/Slider3.jpg') }}" alt="slide3" class="img-responsive">
</div>


</div>
<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
<span class="sr-only">{{trans('cpanel.Previous')}}</span>
</a>
<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
<span class="sr-only">{{trans('cpanel.Next')}}</span>
</a>
</div>    
</div>    
</div>
<ul class="list-unstyled list-tabs">
<li class="selected custom-js" data-class="tab1"> {{trans('cpanel.Map')}} </li>   
<li data-class="tab2">{{trans('cpanel.Images')}} </li>   
</ul>     
</div>    
</div>
<!--*******************************************************-->
<section class="cases">
   <div class="container">
      <div class="row">
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="{{lang_url('cases').'?section=6'}}"><img src="{{ URL::to('public/assets/Frontend/img/s1.png') }}" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="{{lang_url('cases').'?section=5'}}"><img src="{{ URL::to('public/assets/Frontend/img/s2.png') }}" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="{{lang_url('cases').'?section=4'}}"><img src="{{ URL::to('public/assets/Frontend/img/s3.png') }}" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="{{lang_url('cases').'?section=3'}}"><img src="{{ URL::to('public/assets/Frontend/img/s4.png') }}" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="{{lang_url('cases').'?section=2'}}"><img src="{{ URL::to('public/assets/Frontend/img/s5.png') }}" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="{{lang_url('cases').'?section=1'}}"><img src="{{ URL::to('public/assets/Frontend/img/s6.png') }}" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="{{lang_url('cases').'?section=12'}}"><img src="{{ URL::to('public/assets/Frontend/img/s12.png') }}" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="{{lang_url('cases').'?section=10'}}"><img src="{{ URL::to('public/assets/Frontend/img/s8.png') }}" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="{{lang_url('cases').'?section=9'}}"><img src="{{ URL::to('public/assets/Frontend/img/s9.png') }}" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="{{lang_url('cases').'?section=8'}}"><img src="{{ URL::to('public/assets/Frontend/img/s10.png') }}" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="{{lang_url('cases').'?section=7'}}"><img src="{{ URL::to('public/assets/Frontend/img/s11.png') }}" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="{{lang_url('cases').'?section=11'}}"><img src="{{ URL::to('public/assets/Frontend/img/s7.png') }}" class="img-responsive"></a>
         </div>
      </div>
   </div>
</section>
<!--******************************************************-->
 

<section class="latestcases">
   <div class="container">
      <h1 class="text-center m-top-bott">{{trans('cpanel.Latest_Cases')}}</h1>
      <div class="row">
      @foreach($latest_cases as $value)
         <div class="col-md-4 m_bottom pull-right">
            <a href="{{lang_url('case').'/'.$value->id}}">
               <div class="case-temp">
                  <p style="height: 64px;">{{$value->title}}</p>
                  <div class="tempp">
                     <div class="casetype"> {{trans('cpanel.Case_type')}} : <span>{{$value->sectionName}}</span></div>
                     <div class="status"> {{trans('cpanel.Status')}} : 

                     <?php
                         if($value->status ==1) echo '<span> متاح</span>';
                         else{
                           echo '</span>غير متاحة</span>'; }
                     ?>
                    </div>
                  </div>
                  <ul class="list-unstyled">
                     <li><i class="fa fa-map-marker" aria-hidden="true"></i> <span>{{$value->name1}} -{{$value->name2}}</span>   </li>
                     <li><i class="fa fa-clock-o" aria-hidden="true"></i> <span></span>
                     <?php
                            Carbon::setLocale($locale);
                            $current = Carbon::now();
                            $old = Carbon::parse($value->created_at);
                            echo $old->diffForHumans($current);
 
                        ?>   </li>
                     <li><i class="fa fa-calendar" aria-hidden="true"></i> <span> 
                        
                         <?php
                            Carbon::setLocale($locale);
                           $now = Carbon::now();
                            $current = Carbon::parse($value->created_at);
                            $old = Carbon::parse($value->finished_date);
                           

                           if ($old < $now)
                           {
                              echo $value->finished_date;
                           }else {

                              echo $old->diffForHumans($current);

                           }
                           ?> 
                      

                     </span>  </li>
                  </ul>
                     @if (empty($value->bidValue))

                  <div class="price"> <i class="fa fa-money" aria-hidden="true"></i>  {{trans('cpanel.Price_top')}}:<span>0$</span> 
                  @else 
                  <div class="price"> <i class="fa fa-money" aria-hidden="true"></i>  {{trans('cpanel.Price_top')}} :<span>{{$value->bidValue}}$</span> 
                  @endif
                  </div>
               </div>
            </a>
         </div>
           @endforeach




   </div>
</section>
<!--**********************************************************-->
<section class="consultants">
   <div class="container-fluid">
      <h1 class="text-center"> {{trans('cpanel.The_best_lawyers')}}</h1>
      <div class="row">
      @foreach($lawyers as $law)
         <div class="col-lg-2 col-md-4 col-sm-6 cons pull-right">
            <a href="{{lang_url('lawyer').'/'.$law->id}}" class="img1">
             <img src="{{ asset('public/uploads/user_img')}}/{{$law->image}}" class="img-responsive"> 
              <span class="name">{{$law->name}} <span class="title">{{$law->career}} </span></span> </a>
         </div>
         @endforeach
      </div>
   </div>
</section>
<!--***********************************************-->
<section class="countries">
   <div class="container">
      <h1 class="text-center"> {{trans('cpanel.Cases_and_Countries')}}  </h1>
      <div class="row">
         <div class="col-md-3 col-sm-6 m_bottom">

         

            <div class="text text-center">
               <a href="{{lang_url('cases').'?country=2'}}"> <img src="{{ URL::to('public/assets/Frontend/img/c1.png') }}"> </a>
               <p> {{trans('cpanel.Saudi_Arabia')}}  </p>
               <span>{{$saudiCases}} {{trans('cpanel.Case')}} </span>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 m_bottom">
            <div class="text text-center">
               <a href="{{lang_url('cases').'?country=1'}}"> <img src="{{ URL::to('public/assets/Frontend/img/c2.png') }}"> </a>
               <p>{{trans('cpanel.Egypt')}}   </p>
               <span>{{$egyptCases}}  {{trans('cpanel.Case')}} </span>
            </div>
         </div>
         
        <div class="col-md-3 col-sm-6 m_bottom">
            <div class="text text-center">
               <a href="{{lang_url('cases').'?country='}}"> <img src="{{ URL::to('public/assets/Frontend/img/c3.png') }}"> </a>
               <p>{{trans('cpanel.United_Arab_Emirates')}}   </p>
               <span>0 {{trans('cpanel.Case')}} </span>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 m_bottom">
            <div class="text text-center">
               <a href="{{lang_url('cases').'?country='}}"> <img src="{{ URL::to('public/assets/Frontend/img/c4.png') }}"> </a>
               <p>  {{trans('cpanel.Kuwait')}}  </p>
               <span>0 {{trans('cpanel.Case')}} </span>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 m_bottom">
            <div class="text text-center">
               <a href="{{lang_url('cases').'?country=3'}}"> <img src="{{ URL::to('public/assets/Frontend/img/c5.png') }}"> </a>
               <p>{{trans('cpanel.Tunisia')}}    </p>
               <span>{{$tunisiaCases}} {{trans('cpanel.Case')}}</span>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 m_bottom">
            <div class="text text-center">
               <a href="{{lang_url('cases').'?country='}}"> <img src="{{ URL::to('public/assets/Frontend/img/c6.png') }}"> </a>
               <p>{{trans('cpanel.Morocco')}}  </p>
               <span>0 {{trans('cpanel.Case')}}</span>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 m_bottom">
            <div class="text text-center">
               <a href="{{lang_url('cases').'?country=5'}}"> <img src="{{ URL::to('public/assets/Frontend/img/c7.png') }}"> </a>
               <p> {{trans('cpanel.Algeria')}} </p>
               <span>{{$algeriaCases}} {{trans('cpanel.Case')}} </span>
            </div>
         </div>

         <div class="col-md-3 col-sm-6 m_bottom">
            <div class="text text-center">
               <a href="{{lang_url('cases').'?country='}}"> <img src="{{ URL::to('public/assets/Frontend/img/c8.png') }}"> </a>
               <p> {{trans('cpanel.Bahrain')}}  </p>
               <span>0 {{trans('cpanel.Case')}} </span>
            </div>
         </div>
      </div>
   </div>
</section>
<!--*************************************-->
<section class="stat">
   <div class="container">
      <div class="row">
            <div class="col-md-3 col-sm-6 m-top">
            <p class="count-text ">{{trans('cpanel.Finished_cases')}}  </p>      
            <h2 class="timer count-title counter" data-count="{{$countDoneCases}}"></h2>
            </div>    

            <div class="col-md-3 col-sm-6 m-top">
            <p class="count-text ">{{trans('cpanel.Lawyers_count')}}  </p>      
            <h2 class="timer count-title counter" data-count="{{$countLawyers}}" ></h2>
            </div>


            <div class="col-md-3 col-sm-6 m-top">
            <p class="count-text ">{{trans('cpanel.Clients_count')}}  </p> 
            <h2 class="timer count-title counter" data-count="{{$countUsers}}"></h2>
            </div>   


            <div class="col-md-3 col-sm-6 m-top">
            <p class="count-text ">{{trans('cpanel.Cases_count')}} </p>       
            <h2 class="timer count-title counter" data-count="{{$countAllCases}}"></h2>
            </div>    
      </div>       
   </div>    
</section>    
@stop
