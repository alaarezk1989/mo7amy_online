

@extends(FEI.'.master')
@section('content')
<section class="details">
   <div class="container">
      <div class="row">
         <div class="de-Fsection">
            <p>
               <?= $case['title']; ?>
            </p>
            <div>
               <div class="casetype"> نوع القضية : <span><?= $case['type']; ?></span></div>
               <div class="status"> الحالة :                    <?php
                  if($case['status'] ==1) echo '<span> متاح</span>';
                  else{echo '</span>غير متاحة</span>'; }
                       ?></div>
            </div>
            <div style="margin-top:5px">
               <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
               <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
               <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>
                  باقى <span>55</span> يوم
               </div>
            </div>
         </div>
         <div class="col-md-4 ma">
            <div class="all-deatils">
               <div class="account-case">
                  <img src="img/Case%20Account.png">
                  <h3><?= $user_case->name?></h3>
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                  <div class="opinion">
                     <span> (4.25) </span>
                     <span> 99</span> أراء
                  </div>
               </div>
               <div class="case-price">
                  <h4>$ 20,000</h4>
                  اعلى سعر
               </div>
               <div class="numofviews">
                  <h4>$ 100,000</h4>
                  عدد المشاهدات
               </div>
               <div class="numooffers">
                  <h4>$ 1000</h4>
                  عدد العروض
               </div>

               @if(auth()->user())
                 @if(user_auth()->permissions=='lawyer')
               <div class="forresvation">
                  {{--
                  <form action="" method=""> --}}
                     <input type="text" class="form-control" placeholder="حدد سعرك" id="bids_val">
                     <button type="submit" id="bids_button">قدم عرضك  </button>
                     {{--
                  </form>
                  --}}
               </div>
               @endif
             @endif

            </div>
         </div>
         <div class="col-md-8 ma">
            <div class="more-details">
               <h4>التفاصيل </h4>
               <p>
                  <?= $case['description']; ?>
               </p>
            </div>
         </div>
      </div>
   </div>
</section>
<!--***********************************************************************-->

@if(auth()->user())
@if(user_auth()->permissions=='client')

<div class="container-fluid head-off">
   <div class="row">
      <img src="{{ URL::to('public/assets/Frontend/img/Case%20Details%20Page%20Image.png') }}" class="img-responsive">
   </div>
</div>
<section class="offers">
   <div class="container">
      <div class="row">
         <div class="arrange">
            <i class="fa fa-sort " aria-hidden="true"></i>
            <div class="dropdown">
               <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
               ترتيب
               <span class="caret"></span>
               </button>
               <ul class="dropdown-menu arrang-menu" aria-labelledby="dropdownMenu1">
                  <li><a href="#">اعلى سعر </a></li>
                  <li><a href="#">اقل سعر  </a></li>
                  <li><a href="#"> احدث عرض  </a></li>
               </ul>
            </div>
            <p>
               يظهر
               <spa> 0- 8 </spa>
               من <span> 25 </span>  نتيجة
            </p>
            <div id='page_navigation'></div>
         </div>
         <!--***********************************************-->
         <input type='hidden' id='current_page' />
         <input type='hidden' id='show_per_page' />
         <div id='content'>
            <div class="col-md-3 text-center border-bott padd-top border-rght">
               <div class="law-profile">
                  <a href="#"> <img src="img/Profile%20Image-1.png" class="imgs"> </a>
                  <a href="#">
                     <p class="names">خالد كامل </p>
                  </a>
                  <a href="#">
                     <p class="desc">مستشار محكمة النقض الدولى <span> مصر , القاهرة </span>  </p>
                  </a>
                  <div class="offers"> سعر العرض:  $ 1,000,000 </div>
                  <button onclick="" class="okk">قبلت عرضك </button>
               </div>
            </div>
            <div class="col-md-3 text-center border-bott padd-top border-rght">
               <div class="law-profile">
                  <a href="#"> <img src="img/Profile%20Image-1.png" class="imgs"> </a>
                  <a href="#">
                     <p class="names">خالد كامل </p>
                  </a>
                  <a href="#">
                     <p class="desc">مستشار محكمة النقض الدولى <span> مصر , القاهرة </span>  </p>
                  </a>
                  <div class="offers"> سعر العرض:  $ 1000.000 </div>
                  <button onclick="" class="okk">قبلت عرضك </button>
               </div>
            </div>
            <div class="col-md-3 text-center border-bott padd-top border-rght">
               <div class="law-profile">
                  <a href="#"> <img src="img/Profile%20Image-1.png" class="imgs"> </a>
                  <a href="#">
                     <p class="names">خالد كامل </p>
                  </a>
                  <a href="#">
                     <p class="desc">مستشار محكمة النقض الدولى <span> مصر , القاهرة </span>  </p>
                  </a>
                  <div class="offers"> سعر العرض:  $ 1000.000 </div>
                  <button onclick="" class="okk">قبلت عرضك </button>
               </div>
            </div>
            <div class="col-md-3 text-center border-bott padd-top ">
               <div class="law-profile">
                  <a href="#"> <img src="img/Profile%20Image-1.png" class="imgs"> </a>
                  <a href="#">
                     <p class="names">خالد كامل </p>
                  </a>
                  <a href="#">
                     <p class="desc">مستشار محكمة النقض الدولى <span> مصر , القاهرة </span>  </p>
                  </a>
                  <div class="offers"> سعر العرض:  $ 1000.000 </div>
                  <button onclick="" class="okk">قبلت عرضك </button>
               </div>
            </div>
            <div class="col-md-3 text-center  padd-top border-rght">
               <div class="law-profile">
                  <a href="#"> <img src="img/Profile%20Image-1.png" class="imgs"> </a>
                  <a href="#">
                     <p class="names">خالد كامل </p>
                  </a>
                  <a href="#">
                     <p class="desc">مستشار محكمة النقض الدولى <span> مصر , القاهرة </span>  </p>
                  </a>
                  <div class="offers"> سعر العرض:  $ 1000.000 </div>
                  <button onclick="" class="okk">قبلت عرضك </button>
               </div>
            </div>
            <div class="col-md-3 text-center  padd-top border-rght">
               <div class="law-profile">
                  <a href="#"> <img src="img/Profile%20Image-1.png" class="imgs"> </a>
                  <a href="#">
                     <p class="names">خالد كامل </p>
                  </a>
                  <a href="#">
                     <p class="desc">مستشار محكمة النقض الدولى <span> مصر , القاهرة </span>  </p>
                  </a>
                  <div class="offers"> سعر العرض:  $ 1000.000 </div>
                  <button onclick="" class="okk">قبلت عرضك </button>
               </div>
            </div>
            <div class="col-md-3 text-center  padd-top border-rght">
               <div class="law-profile">
                  <a href="#"> <img src="img/Profile%20Image-1.png" class="imgs"> </a>
                  <a href="#">
                     <p class="names">خالد كامل </p>
                  </a>
                  <a href="#">
                     <p class="desc">مستشار محكمة النقض الدولى <span> مصر , القاهرة </span>  </p>
                  </a>
                  <div class="offers"> سعر العرض:  $ 1000.000 </div>
                  <button onclick="" class="okk">قبلت عرضك </button>
               </div>
            </div>
            <div class="col-md-3 text-center padd-top border-rght">
               <div class="law-profile">
                  <a href="#"> <img src="img/Profile%20Image-1.png" class="imgs"> </a>
                  <a href="#">
                     <p class="names">خالد كامل </p>
                  </a>
                  <a href="#">
                     <p class="desc">مستشار محكمة النقض الدولى <span> مصر , القاهرة </span>  </p>
                  </a>
                  <div class="offers"> سعر العرض:  $ 1000.000 </div>
                  <button onclick="" class="okk">قبلت عرضك </button>
               </div>
            </div>
            <div class="col-md-3 text-center padd-top">
               <div class="law-profile">
                  <a href="#"> <img src="img/Profile%20Image-1.png" class="imgs"> </a>
                  <a href="#">
                     <p class="names">خالد كامل </p>
                  </a>
                  <a href="#">
                     <p class="desc">مستشار محكمة النقض الدولى <span> مصر , القاهرة </span>  </p>
                  </a>
                  <div class="offers"> سعر العرض:  $ 1000.000 </div>
                  <button onclick="" class="okk">قبلت عرضك </button>
               </div>
            </div>
            <!--*********************************************-->
            <div class="col-md-3 text-center border-bott padd-top border-rght">
               <div class="law-profile">
                  <a href="#"> <img src="img/Profile%20Image-2.png" class="imgs"> </a>
                  <a href="#">
                     <p class="names">خالد كامل </p>
                  </a>
                  <a href="#">
                     <p class="desc">مستشار محكمة النقض الدولى <span> مصر , القاهرة </span>  </p>
                  </a>
                  <div class="offers"> سعر العرض:  $ 1000.000 </div>
                  <button onclick="" class="okk">قبلت عرضك </button>
               </div>
            </div>
            <div class="col-md-3 text-center border-bott padd-top border-rght">
               <div class="law-profile">
                  <a href="#"> <img src="img/Profile%20Image-2.png" class="imgs"> </a>
                  <a href="#">
                     <p class="names">خالد كامل </p>
                  </a>
                  <a href="#">
                     <p class="desc">مستشار محكمة النقض الدولى <span> مصر , القاهرة </span>  </p>
                  </a>
                  <div class="offers"> سعر العرض:  $ 1000.000 </div>
                  <button onclick="" class="okk">قبلت عرضك </button>
               </div>
            </div>
            <div class="col-md-3 text-center border-bott padd-top border-rght">
               <div class="law-profile">
                  <a href="#"> <img src="img/Profile%20Image-2.png" class="imgs"> </a>
                  <a href="#">
                     <p class="names">خالد كامل </p>
                  </a>
                  <a href="#">
                     <p class="desc">مستشار محكمة النقض الدولى <span> مصر , القاهرة </span>  </p>
                  </a>
                  <div class="offers"> سعر العرض:  $ 1000.000 </div>
                  <button onclick="" class="okk">قبلت عرضك </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endif
@endif
@stop
<!--*************************************************-->
