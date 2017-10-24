@extends(FEI.'.master')
@section('content')
<?php
use Carbon\Carbon;
$locale = App::getLocale();

?>
  <!--*******************************************************************-->
  <section class="profile">
     <div class="container-fluid">
        <div class="row">
           <div class="cover-container">
              <img src="{{ asset('public/assets/'.FE .'/img/Lawyer-Profile-Page-Image-1.jpg')}}" alt="cover" class="parent-img margin-top">
           </div>
           <div class="top-container">
             @if($user_data->image !='')
               <img src="{{ asset('public/uploads/user_img')}}/{{$user_data->image}}" alt="{{$user_data->name}}" class="child-img img-circle"" />
             @else
               <img src="{{ asset('public/uploads')}}/avater.png" alt="profile" class="child-img img-circle""/>
             @endif

              {{-- <div class="profile-container">
                 <form id="form-profile">
                    <label tabindex="0" for="my-file" class="input-file-trigger label2">
                      <i class="fa fa-camera" aria-hidden="true"></i></label>
                    <input class="input-file" id="my-file" type="file">
                 </form>
              </div> --}}
           </div>
        </div>
     </div>

     <div class="container">
        <div class="row">
           <div class="col-md-4">
              <div class="lawyer-info">
                 <h4>{{trans('cpanel.Information_about_lawyer')}}</h4>
                 <ul class="list-unstyled ul-lawyer">
                    <li> <i class="fa fa-map-marker" aria-hidden="true"></i>  {{$user_country}} , {{$user_city}}  </li>
                    <li> <i class="fa fa-birthday-cake" aria-hidden="true"></i>  {{$birthdate_year}} {{trans('cpanel.year')}} </li>

                    <li> <i class="fa fa-phone" aria-hidden="true"></i> @if($show_lowyer_contact_flag) {{$user_data->phone}} @endif</li>
                    <li> <i class="fa fa-envelope" aria-hidden="true"></i>  @if($show_lowyer_contact_flag)  {{$user_data->email}}@endif</li>
                 </ul>
                 <span class="text-center"> {{$countLawyersCases}} </span>
                 <p class="text-center"> {{trans('cpanel.Cases_That_Participate')}} </p>
                 @if($show_lowyer_contact_flag)
                 <a href="tel:{{$user_data->phone}}" class="text-center"> اتصل بالمحامى </a>
                 @endif
              </div>
           </div>
           <div class="col-md-8">
              <div class="info1">
                 <h2>{{$user_data->name}}  </h2>
                 <p>{{$user_data->career}}</p>
                 <span>

                  {{trans('cpanel.type_of_specialization')}} :
                    @php
                    $i=1;
                      foreach ($user_specialty as $row_specialty){
                      echo $row_specialty->s_name;
                      if($i < count($user_specialty)){
                        echo ' - ';
                      }
                      $i++;
                    }
@endphp
                    </span>
                 {{-- <ul class="list-unstyled prof-social">
                    <li> <a herf="">  <i class="fa fa-facebook"></i>  </a>  </li>
                    <li> <a herf="">  <i class="fa fa-twitter"></i>  </a>  </li>
                    <li> <a herf="">  <i class="fa fa-linkedin"></i>  </a>  </li>
                    <li> <a herf="">  <i class="fa fa-google-plus"></i> </a>  </li>
                 </ul> --}}
                 <div class="about-lawyer">

                    <h4>{{trans('cpanel.about_lawyer')}} </h4>
                    <p>
                      {{$user_data->short_description}}
                    </p>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </section>
  <!--*************************************************************************-->
@if($lawyerCases->count() > 0)
  <div class="profilecase-img">
  <p> {{trans('cpanel.Cases_That_Participate')}} </p>
  </div>


  <section class="offers">
     <div class="container">
        <div class="row">

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
                        <span> 0- {{ $lawyerCases->perPage() }} </span>
                        {{trans('cpanel.of')}}
                        <span> {{$lawyerCases->total()}} </span>{{trans('cpanel.result')}}
                     </p>
                     <div id='page_navigation'>{{ $lawyerCases->links() }}</div>
                  </div>


           <!--***********************************************-->
           <input type='hidden' id='current_page' />
           <input type='hidden' id='show_per_page' />



        <div id='content'>



           @foreach($lawyerCases as $lawyerCase)
            <a href="{{lang_url('case').'/'.$lawyerCase->id}}">
              <div class="case-client border-bott">
                 <p> {{$lawyerCase->title}}  </p>
                 <div>
                    <div class="casetype"> {{trans('cpanel.Case_type')}} : <span>{{$lawyerCase->sectionName}}</span></div>
                     <div class="status"> {{trans('cpanel.Status')}} :

                     <?php
                         if($lawyerCase->status ==1) 
                          {
                            $x= trans('cpanel.Available');
                            echo '<span class="avail">'.$x.' </span>';
                          }
                         elseif($lawyerCase->status ==2) 
                          { $y= trans('cpanel.Under_Implementation');
                            echo '<span class="unConst">'.$y.'</span>';
                          }
                         else{
                          $z= trans('cpanel.Finished');
                           echo '<span class="unavail">'.$z.'</span>'; 
                         }
                     ?>


    
                    </div>
                   <div class="price"><i class="fa fa-money" aria-hidden="true"></i> {{trans('cpanel.Case_Offer')}} {{$lawyerCase->bid_value}} $</div>
                   <div class="price"><i class="fa fa-money" aria-hidden="true"></i> {{trans('cpanel.Price_top')}}{{$lawyerCase->max_bid_value}} $</div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$lawyerCase->name1}} -{{$lawyerCase->name2}} </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span></span> <?php
                            Carbon::setLocale($locale);
                            $current = Carbon::now();
                            $old = Carbon::parse($lawyerCase->created_at);
                            echo $old->diffForHumans($current);

                        ?> </div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span></span> <?php
                            Carbon::setLocale($locale);
                            $current = Carbon::parse($lawyerCase->created_at);
                            $old = Carbon::parse($lawyerCase->finished_date);
                           echo $old->diffForHumans($current);
                           ?> </div>

         

                 </div>
              </div>
            </a>

              @endforeach

        </div>



           </div>
        </div>
     </div>
  </section>
  @endif
  <!--*******************************************-->
  <!--******************************Modal******************************-->
  <div class="modal fade" id="editvideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel"> <i class="fa fa-pencil" aria-hidden="true"></i>تعديل الفيديو</h4>
           </div>
           <div class="modal-body">
              <form>
                 <div class="form-group">
                    <input type="text" class="form-control" id="recipient-name" placeholder="تعديل العنوان">
                 </div>
                 <div class="form-group">
                    <textarea class="form-control" id="message-text" placeholder="تعديل الوصف "></textarea>
                 </div>
              </form>
           </div>
           <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
              <button type="button" class="btn btn-primary saving">حفظ</button>
           </div>
        </div>
     </div>
  </div>
  <!--************************modal for delete ***************************-->
  <div class="modal fade" id="deletetvideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash" aria-hidden="true"></i> مسح الفيديو </h4>
           </div>
           <div class="modal-body">
              <p>هل تريد مسح هذا ؟ </p>
              <p> هل انت متأكد ؟</p>
           </div>
           <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">الغاء </button>
              <button type="button" class="btn btn-primary ms7">مسح</button>
           </div>
        </div>
     </div>
  </div>
  <!--*************************************************-->




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <script >


      </script>


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
var page ='/{{$user_data->id}}'+'?page='+p;
var page_link=0;
//var url =  "{!! lang_url('cases/filtering') !!}"+page;
// alert(url);
            $.ajax({
              type: "GET",
              url: "{!! lang_url('lawyer/lawyer_cases_filtering') !!}"+page,
              data: filters,
              success: function(result){
               console.log(result);
              html='';
              var total_per_page=result.data['total'];
              $('#total_per_page').text(total_per_page);

              if(total_per_page ==0){
                $('#page_navigation').hide();
              }
              if(total_per_page >0){
                $('#page_navigation').show();
                var last_page=result.data['last_page'];
                $('#page_navigation').children().show();
                $('#page_navigation').find('a').each(function() {
                     page_link=$(this).text();
                     if(page_link > last_page){
                       $(this).hide();
                     }
                      // alert('mmss'+$(this).text());
                });
              }

             if(result.data.data ==false){
             html += '<div class="status" style="font-size: 48px; padding-right: 167px;"> There are no data :)<span>';
             }
                $.each(result.data.data,function(k,v){
                       var case_status = '' ;
                   if(v.status == 1){
                       case_status = '<span class="avail">{{trans('cpanel.Available')}}</span>' ;
                    }
                  if(v.status == 0){
                       case_status = '<span class="unavail">{{trans('cpanel.Finished')}}</span>' ;
                    }
                    if(v.status == 2){
                        case_status = '<span class="unConst">{{trans('cpanel.Under_Implementation')}} </span>' ;
                    }


                    if(v.bidValue == null){
                        v.bidValue = "0" ;
                    }else{
                        v.bidValue =  v.bidValue ;
                    }
                    html += '<a href="<?= lang_url('case').'/' ; ?>'+v.id+'">';
                    html += '<div class="case-client border-bott">';

                    html += '<p>'+v.title+'</p>  ';
                    html += '</a>';
                    html += '<div> ';
                    html += '<div class="casetype"> {{trans('cpanel.Case_type')}} : <span>'+v.sectionName+'</span></div>';
                    html += '<div class="status"> {{trans('cpanel.Status')}} : <span>'+case_status+'</span></div> ';
                    html += '<div class="price"><i class="fa fa-money" aria-hidden="true"></i> {{trans('cpanel.Case_Offer')}} :'+v.bid_value+' $</div>';
                    html +='<div class="price"><i class="fa fa-money" aria-hidden="true"></i> {{trans('cpanel.Price_top')}} : '+v.max_bid_value+'  $</div>'

                    html += '</div> ';
                    html += '<div class="another-details">';
                    html += '<div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> '+v.name1+' ,  '+v.name2+' </div>';
                    html += '<div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> '+v.created_at+'</div>';
                    html += '<div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>'+v.finished_date+'</div>';
               

                    html += '</div>';
                    html += '</div>';
                    html += '</a>';





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
