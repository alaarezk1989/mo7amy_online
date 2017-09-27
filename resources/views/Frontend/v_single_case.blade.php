

@extends(FEI.'.master')
@section('content')
<?php

use Carbon\Carbon;
$locale = App::getLocale();

?>
<section class="details">
   <div class="container">
      <div class="row">
         <div class="de-Fsection">
            <p>
            {{$case->title}}
            </p>
            <div>
               <div class="casetype"> نوع القضية : <span>{{$case->sectionName}}</span></div>
               <div class="status"> الحالة :                    <?php
                  if($case->status) echo '<span> متاح</span>';
                  else{echo '</span>غير متاحة</span>'; }
                       ?></div>
            </div>
            <div style="margin-top:5px">
               <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$case->country_name}} - {{$case->city_name}} </div>
               <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i>
                        <?php
                            Carbon::setLocale($locale);
                            $current = Carbon::now();
                            $old = Carbon::parse($case->created_at);
                            echo $old->diffForHumans($current);

                        ?>



               </div>
               <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>
                        <?php
                            Carbon::setLocale($locale);
                            $current = Carbon::parse($case->created_at);
                            $old = Carbon::parse($case->finished_date);
                           echo $old->diffForHumans($current);
                         ?>
               </div>
            </div>
         </div>
         <div class="col-md-4 ma">
            <div class="all-deatils">
               <div class="account-case">
                  <img class="img-circle" src="img/Case%20Account.png">
                  <h3>{{$user_case->name}}</h3>
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                  <div class="opinion">
                     <span> (0) </span>
                     <span> 0</span> أراء
                  </div>
               </div>
               <div class="case-price">
               @if (empty($case->bidValue))
                      <h4>0$</h4>
                  اعلى سعر
               </div>
                @else
                  <h4>{{$case->bidValue}}$</h4>
                  اعلى سعر
               </div>
                            @endif

               <div class="numofviews">
                  <h4>{{$view_counter}}</h4>
                  عدد المشاهدات
               </div>
               <div class="numooffers">
                  <h4>{{$offerCount}}</h4>
                  عدد العروض
               </div>

               @if(auth()->user())

               <div class="forresvation" id="bids_div">
                  @if(user_auth()->permissions=='lawyer')
                    @if(!empty($case_bids))
                    <button><span>{{ trans('cpanel.you_offer') }}</span> {{$case_bids->bids_val}} $ </button>
                  @else
                    {!! Form::open(['method'=>'POST','id'=>'form_set_bids','url'=>'set_your_bids/'.$id]) !!}

                      {!! Form::text('bids_val','', array('class'=>'form-control','id'=>'bids_val','placeholder'=>'حدد سعر', 'required'=>'required' ) ) !!}
                      {!! Form::hidden('case_id',$id, array('id'=>'case_id') ) !!}
                         <button type="submit" id="bids_button">{{ trans('cpanel.put_you_offer') }} </button>
                    {!! Form::close() !!}
                  @endif
                @endif

               </div>

             @endif

            </div>
         </div>
         <div class="col-md-8 ma">
            <div class="more-details">
               <h4>التفاصيل </h4>
               <p>
                 {{$case->description}}
               </p>
            </div>
         </div>
      </div>
   </div>
</section>
<!--***********************************************************************-->

@if(auth()->user())
@if(user_auth()->permissions=='lawyer' or 'client')

<div class=" head-off">
 <p> العروض المقدمة </P>
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

             @foreach($all_case_bids as $user_bids)


            <div class="col-md-3 text-center border-bott padd-top border-rght">
               <div class="law-profile">
                  <a href="{{lang_url('lawyer').'/'.$user_bids->id}}">

                    @if($user_bids->image !='')
                      <img src="{{ asset('public/uploads/user_img')}}/{{$user_bids->image}}" class="imgs img-circle" />
                    @else
                       <img src="{{ asset('public/uploads')}}/avater.png" class="imgs img-circle">
                    @endif
                  </a>
                  <a href="{{lang_url('lawyer').'/'.$user_bids->id}}">
                     <p class="names">{{$user_bids->name}} </p>
                  </a>
                  <a href="{{lang_url('lawyer').'/'.$user_bids->id}}">
                     <p class="desc">{{$user_bids->career}}
                       <span> {{$user_bids->country_name}} , {{$user_bids->city_name}} </span>
                     </p>
                  </a>
                   @if($sess_user_id= session('user_id') == $case->user_id)
                  <div class="offers">سعر العرض:  $ {{$user_bids->bids_val}}  </div>
                    @if($user_bids->status == 1)
                  <button data-target="#confirmation_{{$user_bids->id}}"  data-toggle="modal" class="okk">قبلت عرضك </button>


            <div class="modal fade" id="confirmation_{{$user_bids->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">

            <div class="modal-dialog" role="document">

            <div class="modal-content">

            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel"><!--<i class="fa fa-trash" aria-hidden="true"></i>--> رسالة تأكيد </h4>
            </div>


            <div class="modal-body">
            <p>هل انت متاكد من قبول هذا العرض ؟</p>
            </div>
    {!! Form::open(['method'=>'POST', 'id'=>'apply_bids_form', 'url'=>'']) !!}
            <input type="hidden" value="{{$user_bids->id}}" name="user_bids_id">
            <input type="hidden" value="{{$user_bids->case_id}}" name="case_id" >

              <div class="modal-footer">
                  <button type="button" class="btn btn-default yes " id="apply_bids_button" onclick="return apply_bids_fun({{$user_bids->id}},{{$user_bids->case_id}});" data-dismiss="modal">نعم </button>
                  <button type="reset" class="btn btn-primary no"  data-dismiss="modal">لا</button>
              </div>
{!! Form::close() !!}

          </div>
          </div>
          </div>
            @endif

                  @else
                  <div class="offers">سعر العرض:  $ {{$user_bids->bids_val}}  </div>
                  @endif
               </div>
            </div>
               @endforeach

         </div>
      </div>
   </div>
</section>
@endif
@endif
@stop



<!--*************************************************-->
