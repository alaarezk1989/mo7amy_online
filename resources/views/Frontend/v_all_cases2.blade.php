@extends(FEI.'.master')
@section('content')
<?php
use Carbon\Carbon;
$locale = App::getLocale();
?>
<div class="cases-img">
 <p>   نتيجة البحث </p>
</div>

<section class="offers">
<div class="container">
<div class="row">

<form method="get" role="search" action="{{lang_url('cases/search')}}">
  {{ csrf_field() }}



<div class=" sidebar2 res-search">
<div class="forsearch">
<label> البحث </label>
<input type="search" name="q" class="form-control" value="{{$query}}">
<button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
</div>
</div>


</form>





 @if(isset($details))
                 <div class="arrange">
                     <i class="fa fa-sort " aria-hidden="true"></i>
                     <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        {{ trans('cpanel.arranging') }}
                        <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu arrang-menu" aria-labelledby="dropdownMenu1">
                           <li><a id="max"href="#">{{ trans('cpanel.highest_price') }}</a></li>
                           <li><a id="low"href="#">{{ trans('cpanel.lowest_price') }}</a></li>
                           <li><a id="latest"href="#">{{ trans('cpanel.latest_show') }} </a></li>
                        </ul>
                     </div>

                     <p>
                       {{trans('cpanel.show')}}
                        <span> 0- {{ $details->perPage() }} </span>
                        {{trans('cpanel.of')}}
                        <span>   {{$details->total()}} </span>{{trans('cpanel.result')}}
                     </p>

                     <div id='page_navigation'>{{ $details->links() }}</div>

                  </div>
 @endif


<!--***********************************************-->



<input type='hidden' id='current_page' />
<input type='hidden' id='show_per_page' />
   @if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div id='content'>




 @if(isset($details))




@foreach($details as $value)
<a href="{{lang_url('case').'/'.$value->id}}">
<div class="case-client border-bott">
<p> {{$value->title}}</p>
<div>
<div class="casetype"> {{trans('cpanel.Case_type')}} : <span>{{$value->sectionName}}</span></div>




   <div class="status"> {{trans('cpanel.Status')}} :

                     <?php
                         if($value->status ==1) 
                          {
                            echo '<span class="avail"> متاح</span>';
                          }
                         elseif($value->status ==2) 
                          {
                            echo '<span class="unConst">تحت التنفيذ</span>';
                          }
                         else{
                           echo '<span class="unavail">غير متاحة</span>'; 
                         }
                     ?>


    
                    </div>
      <div class="price"><i class="fa fa-money" aria-hidden="true"></i>{{trans('cpanel.Price_top')}} :{{$value->bidValue}} $</div>

</div>
<div class="another-details">
<div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$value->name1}} - {{$value->name2}}</div>
<div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i><?php
                            Carbon::setLocale($locale);
                            $current = Carbon::now();
                            $old = Carbon::parse($value->created_at);
                            echo $old->diffForHumans($current);

?></div>
<div class="time"><i class="fa fa-calendar" aria-hidden="true"></i><?php
                            Carbon::setLocale($locale);
                            $current = Carbon::parse($value->created_at);
                            $old = Carbon::parse($value->finished_date);
                           echo $old->diffForHumans($current);
                           ?></div>


</div>
</div>
</a>

@endforeach
@elseif(isset($message))
         <p>{{ $message }}</p>
         @endif











</div>

</div>
</div>
</section>


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


            filters = {'sortBy':sortBy,'q':'{{ $query }}'} ;

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
var page ='?page='+p;
var page_link=0;
//var url =  "{!! lang_url('cases/filtering') !!}"+page;
// alert(url);
            $.ajax({
              type: "GET",
              url: "{!! lang_url('cases/searchFiltering') !!}"+page,
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

             // $('.test').hide(next_page_test);
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
                    html += '<div> ';
                    html += '<div class="casetype"> نوع القضية : <span>'+v.sectionName+'</span></div>';
                    html += '<div class="status"> الحالة : <span>'+case_status+'</span></div> ';
                    html += '<div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :'+v.bidValue+' $</div>';

                    html += '</div> ';
                    html += '<div class="another-details">';
                    html += '<div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> '+v.name1+' ,  '+v.name2+' </div>';
                    html += '<div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> '+v.created_at+'</div>';
                    html += '<div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>'+v.finished_date+'</div>';
                    html += '</div> </div>';
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

<!--*******************************************-->
