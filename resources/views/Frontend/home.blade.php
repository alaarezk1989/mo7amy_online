


@extends(FEI.'.master')
@section('content')

<?php
use Carbon\Carbon;
?>
<div class="container-fluid">
   <div class="row">
      <ul class="list-unstyled list-tabs">
         <li class="selected custom-js" data-class="tab1">الخريطة  </li>
         <li data-class="tab2"> الصور   </li>
      </ul>
      <div class="tabs-content">
         <div class="tab1">
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
                     <img src="{{ URL::to('public/assets/Frontend/img/Slider1.png') }}" alt="...">
                  </div>
                  <div class="item">
                     <img src="{{ URL::to('public/assets/Frontend/img/Slider1.png') }}" alt="...">
                  </div>
               </div>
               <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
               <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
               <span class="sr-only">Previous</span>
               </a>
               <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
               <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
               <span class="sr-only">Next</span>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
<!--*******************************************************-->
<section class="cases">
   <div class="container">
      <div class="row">
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="#"><img src="img/s1.png" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="#"><img src="img/s2.png" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="#"><img src="img/s3.png" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="#"><img src="img/s4.png" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="#"><img src="img/s5.png" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="#"><img src="img/s6.png" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="#"><img src="img/s12.png" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="#"><img src="img/s8.png" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="#"><img src="img/s9.png" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="#"><img src="img/s10.png" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="#"><img src="img/s11.png" class="img-responsive"></a>
         </div>
         <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="#"><img src="img/s7.png" class="img-responsive"></a>
         </div>
      </div>
   </div>
</section>
<!--******************************************************-->
 

<section class="latestcases">
   <div class="container">
      <h1 class="text-center m-top-bott">احدث القضايا </h1>
      <div class="row">
      @foreach($latest_cases as $value)
         <div class="col-md-4 m_bottom">
            <a href="{{lang_url('case').'/'.$value->id}}">
               <div class="case-temp">
                  <p>{{$value->description}}</p>
                  <div class="tempp">
                     <div class="casetype"> نوع القضية : <span>{{$value->type}}</span></div>
                     <div class="status"> الحالة : 

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
                            $current = Carbon::now();
                            $old = Carbon::parse($value->created_at);
                           echo $old->diffInHours($current);
 
                        ?>   </li>
                     <li><i class="fa fa-calendar" aria-hidden="true"></i> <span> 

                      

                     </span>  </li>
                  </ul>
                  <div class="price"> <i class="fa fa-money" aria-hidden="true">  </i>  اعلى سعر :<span>200,000</span> </div>
               </div>
            </a>
         </div>
           @endforeach




   </div>
</section>
<!--**********************************************************-->
<section class="consultants">
   <div class="container-fluid">
      <h1 class="text-center"> افضل الاستشاريين</h1>
      <div class="row">
         <div class="col-lg-2 col-md-4 col-sm-6 cons">
            <a href="profile-case.html" class="img1"> <img src="img/1.png" class="img-responsive">  <span class="name">ندى محمد <span class="title">محامى بمحاكم مجلس الدولة  </span></span> </a>
         </div>
         <div class="col-lg-2 col-md-4 col-sm-6 cons">
            <a href="profile-case.html" class="img1"> <img src="img/2.png" class="img-responsive"><span class="name">احمد محمد <span class="title">محامى بمحاكم مجلس الدولة </span></span>  </a>
         </div>
         <div class="col-lg-2 col-md-4 col-sm-6 cons">
            <a href="profile-case.html" class="img1"> <img src="img/3.png" class="img-responsive"><span class="name">هبة احمد <span class="title">محامى بمحاكم مجلس الدولة </span></span>  </a>
         </div>
         <div class="col-lg-2 col-md-4 col-sm-6 cons">
            <a href="profile-case.html" class="img1"> <img src="img/4.png" class="img-responsive"><span class="name">مالك محمد <span class="title">محامى بمحاكم مجلس الدولة </span></span>  </a>
         </div>
         <div class="col-lg-2 col-md-4 col-sm-6 cons">
            <a href="profile-case.html" class="img1"> <img src="img/5.png" class="img-responsive"><span class="name"> فريدة احمد <span class="title">محامى بمحاكم مجلس الدولة </span></span>  </a>
         </div>
         <div class="col-lg-2 col-md-4 col-sm-6 cons">
            <a href="profile-case.html" class="img1"> <img src="img/6.png" class="img-responsive"><span class="name">على عبدالرحمن<span class="title">محامى بمحاكم مجلس الدولة </span></span>  </a>
         </div>
      </div>
   </div>
</section>
<!--***********************************************-->
<section class="countries">
   <div class="container">
      <h1 class="text-center">  الدول والقضايا </h1>
      <div class="row">
         <div class="col-md-3 col-sm-6 m_bottom">
            <div class="text text-center">
               <a href=""> <img src="img/c1.png"> </a>
               <p>السعودية  </p>
               <span>40 قضية </span>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 m_bottom">
            <div class="text text-center">
               <a href=""> <img src="img/c2.png"> </a>
               <p>مصر   </p>
               <span>40 قضية </span>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 m_bottom">
            <div class="text text-center">
               <a href=""> <img src="img/c3.png"> </a>
               <p>الامارات   </p>
               <span>40 قضية </span>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 m_bottom">
            <div class="text text-center">
               <a href=""> <img src="img/c4.png"> </a>
               <p>الكويت   </p>
               <span>40 قضية </span>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 m_bottom">
            <div class="text text-center">
               <a href=""> <img src="img/c5.png"> </a>
               <p>تونس    </p>
               <span>40 قضية </span>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 m_bottom">
            <div class="text text-center">
               <a href=""> <img src="img/c6.png"> </a>
               <p>المغرب </p>
               <span>40 قضية </span>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 m_bottom">
            <div class="text text-center">
               <a href=""> <img src="img/c7.png"> </a>
               <p>  الجزائر </p>
               <span>40 قضية </span>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 m_bottom">
            <div class="text text-center">
               <a href=""> <img src="img/c8.png"> </a>
               <p>  البحرين </p>
               <span>40 قضية </span>
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
            <p class="count-text "> القضايا المنجزة </p>
            <h2 class="timer count-title" id="count-number" data-to="250" data-speed="800"></h2>
         </div>
         <div class="col-md-3 col-sm-6 m-top">
            <p class="count-text "> عدد الاستشاريين </p>
            <h2 class="timer count-title" id="count-number" data-to="350" data-speed="800"></h2>
         </div>
         <div class="col-md-3 col-sm-6 m-top">
            <p class="count-text "> عدد العملاء </p>
            <h2 class="timer count-title" id="count-number" data-to="500" data-speed="800"></h2>
         </div>
         <div class="col-md-3 col-sm-6 m-top">
            <p class="count-text ">عدد القضايا </p>
            <h2 class="timer count-title" id="count-number" data-to="247" data-speed="800"></h2>
         </div>
      </div>
   </div>
</section>
@stop
