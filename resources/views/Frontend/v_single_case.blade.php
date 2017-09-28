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
         <!-- @if(isset($all_case_bids)) -->
         <div class="arrange">
            <i class="fa fa-sort " aria-hidden="true"></i>
            <div class="dropdown">
               <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
               {{ trans('cpanel.arranging') }}
               <span class="caret"></span>
               </button>
               <ul class="dropdown-menu arrang-menu" aria-labelledby="dropdownMenu1">
                  <li><a id="max" href="#">{{ trans('cpanel.highest_price') }}</a></li>
                  <li><a id="low" href="#">{{ trans('cpanel.lowest_price') }}</a></li>
                  <li><a id="latest" href="#">{{ trans('cpanel.latest_show') }} </a></li>
               </ul>
            </div>
            <p>
               {{trans('cpanel.show')}}
               <span> 0- {{ $all_case_bids->perPage() }} </span>
               {{trans('cpanel.of')}}
               <span> {{$all_case_bids->total()}} </span>{{trans('cpanel.result')}}
            </p>
            <div id='page_navigation'>{{ $all_case_bids->links() }}</div>
         </div>
         <!--  @endif -->
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

                  <div class="offers">سعر العرض:  $ {{$user_bids->bids_val}}  </div>
                  @if(session('user_id') == $case->user_id)

                    @if($case->status == 1)
                      <button data-target="#confirmation_{{$user_bids->id}}"  data-toggle="modal" class="okk">قبلت عرضك </button>
                      <div class="modal fade" id="confirmation_{{$user_bids->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                         <div class="modal-dialog" role="document">
                            <div class="modal-content">
                               <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="exampleModalLabel">
                                     <!--<i class="fa fa-trash" aria-hidden="true"></i>--> رسالة تأكيد
                                  </h4>
                               </div>
                               <div class="modal-body">
                                  <p>هل انت متاكد من قبول هذا العرض ؟</p>
                               </div>
                               <div class="modal-footer">
                                  <button type="button" class="btn btn-default yes " id="apply_bids_button" onclick="return apply_bids_fun({{$user_bids->id}},{{$user_bids->case_id}});" data-dismiss="modal">نعم </button>
                                  <button type="reset" class="btn btn-primary no"  data-dismiss="modal">لا</button>
                               </div>
                            </div>
                         </div>
                      </div>
                    @else
                      @if($user_bids->is_pids==1)
                        <button data-target="#confirmation_{{$user_bids->id}}" data-toggle="modal" class="okk done" disabled="disabled" style="background: rgb(179, 31, 36); color: rgb(255, 255, 255);">قبلت عرضك </button>
                      @endif
                    @endif

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script ></script>
<script>
   var filters = [] ;
   var sortBy = '' ;
   var html = '' ;
   //  Call the ajax request
   // getData();

   // Select all


   $(document).ready(function(){
   filterIt() ;
   });

   function filterIt(){
     // $('.loader').hide();
   $('body #sort ,body #max ,body #low ,body #latest').each(function(){
       $(this).on('change click', function(){
       if($(this).attr('id') == 'max'){
           sortBy = $(this).attr('id');
         }
         if($(this).attr('id') == 'low'){
           sortBy = $(this).attr('id');
         }
         if($(this).attr('id') == 'latest'){
           sortBy = $(this).attr('id');
         }
      // $('.loader').show();


   filters = {'sortBy':sortBy} ;

   //  Call the ajax request

   var page_url = $('.active_page').html();
   // alert(page_url);
       getData(page_url);


        html = '' ;



   });
   });

   }

   <?php
      //$page='?page=1';
      if(isset($_GET['page']) && $_GET['page']>0){
        //$page='?page='.$_GET['page'];
      }
      ?>
   function getData(p='1'){
   //var page ='?page='+p;
   var page ='/{{$case->id}}'+'?page='+p;
   //var user_id = <?php echo $sess_user_id= session('user_id'); ?>
   //alert(user_id);
   var page_link=0;
   $.ajax({
     type: "GET",
     url: "{!! lang_url('case/single_cases_filtering') !!}"+page,
     data: filters,
     success: function(result){
     // alert("ttttttt");
      // console.log(result);
     html='';
     var total_per_page=result.data['total'];
     $('#total_per_page').text(total_per_page);

     var last_page=result.data['last_page'];
     $('#page_navigation').find('a').each(function() {
         // console.log($(this).attr('href'));
          page_link=$(this).text();
          if(page_link > last_page){
            $(this).hide();
          }
           // alert('mmss'+$(this).text());
     });
     
    if(result.data.data ==false){
    html += '<div class="status" style="font-size: 48px; padding-right: 167px;"> There are no data :)<span>';
    }
       $.each(result.data.data,function(k,v){


           html += '<div class="col-md-3 text-center border-bott padd-top border-rght">';
           html += '<div class="law-profile">'
           html += '<a href="<?= lang_url('lawyer').'/' ; ?>'+v.id+'">';
          // html += '<img src="{{ asset('public/uploads/user_img').'/'}}'+v.image+'" class="img-responsive img-circle">';
                 if(v.image !=''){

           html += '<img src="{{ asset('public/uploads/user_img').'/'}}'+v.image+'" class="img-responsive img-circle">';

           }
           else{
             html +='<img src="{{ asset('public/uploads')}}/avater.png" class="imgs img-circle">';
           }
           html += '</a>';
            html += '<a href="<?= lang_url('lawyer').'/' ; ?>'+v.id+'">';
           html += '<p class="names">'+v.name+'</p>';
            html += '</a>';
             html += '<a href="<?= lang_url('lawyer').'/' ; ?>'+v.id+'">';
            html += '<p class="desc">'+v.career+'<span> '+v.country_name+', '+v.city_name+' </span></p>';
           html += '</a>';
           html += '<div class="offers">سعر العرض:  $ '+v.bids_val+'</div> ';
var sess_user_id= {{session('user_id')}};
// alert(sess_user_id);
         if(sess_user_id == v.user_id){
             if(v.status == 1){
                html += '<button data-target="#confirmation_'+v.id+'"  data-toggle="modal" class="okk">قبلت عرضك </button>';
                html +='<div class="modal fade" id="confirmation_'+v.id+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">';
                html +='<div class="modal-dialog" role="document">';
                html +='<div class="modal-content">';
                html +='<div class="modal-header">';
                html +='<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                html +='<h4 class="modal-title" id="exampleModalLabel"> رسالة تأكيد </h4>';
                html += '</div> ';
                html += '<div class="modal-body"> ';
                html += '<p>هل انت متاكد من قبول هذا العرض ؟</p> ';
                html += '</div> ';
                html += '<div class="modal-footer"> ';
                html += '<button type="button" class="btn btn-default yes " id="apply_bids_button" onclick="return apply_bids_fun('+v.lawyer_id+','+v.id+');" data-dismiss="modal">نعم </button>';
                html += '<button type="reset" class="btn btn-primary no"  data-dismiss="modal">لا</button> ';
                html += '</div> ';
                html += '</div>';
                html += '</div> ';
                html += '</div>';
          }else{
            if(v.is_pids == 1){
          html +='<button data-target="#confirmation_'+v.id+'" data-toggle="modal" class="okk done" disabled="disabled" style="background: rgb(179, 31, 36); color: rgb(255, 255, 255);">قبلت عرضك </button>';
            }
          }
}
           html += '</div> ';
            html += '</div> ';



       });
      $('#content').html();
       $('#content').html(html);
     // $('.loader').hide();
       //

     }
   });

   }


</script>
<script type="text/javascript">
   $(function() {
       $('body').on('click', '#page_navigation a', function(e) {
           e.preventDefault();

           $('#load a').css('color', '#dfecf6');
           $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

           // var url = $(this).attr('href');


   $(this).addClass('active_page').siblings().removeClass("active_page");
           var url = $(this).html();

           getData(url);
           // window.history.pushStates("", "", url);
       });

       function getArticles(url) {
           $.ajax({
               url : url
           }).done(function (data) {
               $('.articles').html(data);
           }).fail(function () {
               alert('Articles could not be loaded.');
           });
       }
   });

</script>
@stop
<!--*************************************************-->
