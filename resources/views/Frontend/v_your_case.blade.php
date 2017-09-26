@extends(FEI.'.master')
@section('content')
<?php
use Carbon\Carbon;
$locale = App::getLocale();
?>
<div class="container-fluid head-off">
<div class="row">
<img src="{{ URL::to('public/assets/Frontend/img/Client%20Cases%20Page%20Image.png') }}" class="img-responsive">
</div> 
</div> 

<section class="offers wrapper">
<div class="container">
<div class="row">

@if(isset($your_case))
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
                        <span> 0- {{ $your_case->perPage() }} </span>
                        {{trans('cpanel.of')}}
                        <span> {{$your_case->total()}} </span>{{trans('cpanel.result')}}
                     </p>
                     <div id='page_navigation'>{{ $your_case->links() }}</div>
                  </div>

 @endif








<!--***********************************************-->

<input type='hidden' id='current_page' />
<input type='hidden' id='show_per_page' />	
	@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div id='content'>	


@if(isset($your_case))

@foreach($your_case as $value)
<div class="case-client border-bott">
<a href="{{lang_url('case').'/'.$value->id}}">
<p> {{$value->title}}</p>
</a>
<div>   
<div class="casetype"> نوع القضية : <span>{{$value->sectionName}}</span></div>    
<div class="status"> الحالة :                    <?php
                         if($value->status ==1) echo '<span> متاح</span>';
                         else{echo '</span>غير متاحة</span>'; }
                              ?></div>   
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

                            @if (empty($value->bidValue))
<div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :0 $</div> 
                            @else
<div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :{{$value->bidValue}} $</div> 
                            @endif

<div class="imp-button">
  

<a href="{{lang_url('edit-case').'/'.$value->id}}">
<button class="edit">تعديل</button>
</a>
<a href="{{lang_url('delete-case').'/'.$value->id}} "  onclick="return confirm('Are you sure you want to delete this item?');" >
<button class="delt">مسح</button></a>
</div>  
</div> 
</div>
@endforeach  
@endif



 





    



</div>	

</div>
</div>    
</section>

<div id='page_navigation'></div>	



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
var page ='?page='+p;
//var url =  "{!! lang_url('cases/filtering') !!}"+page;
// alert(url);
            $.ajax({
              type: "GET",
              url: "{!! lang_url('cases/your_cases_filtering') !!}"+page,
              data: filters,
              success: function(result){
               console.log(result);
              html='';
              var total_per_page=result.data['total'];
            // var next_page_test=result.data['last_page'];
             // console.log(total_per_page);
              $('#total_per_page').text(total_per_page);
             // $('.test').hide(next_page_test);
             if(result.data.data ==false){
             html += '<div class="status" style="font-size: 48px; padding-right: 167px;"> There are no data :)<span>';
             }
                $.each(result.data.data,function(k,v){
                    if(v.status == 1){
                        v.status = "متاح" ;
                    }else{
                        v.status = "غير متاح" ;
                    }

                    if(v.bidValue == null){
                        v.bidValue = "0" ;
                    }else{
                        v.bidValue =  v.bidValue ;
                    }
                    
                    html += '<div class="case-client border-bott">';
                    html += '<a href="<?= lang_url('case').'/' ; ?>'+v.id+'">';
                    html += '<p>'+v.title+'</p>  ';
                    html += '</a>';
                    html += '<div> ';
                    html += '<div class="casetype"> نوع القضية : <span>'+v.sectionName+'</span></div>';
                    html += '<div class="status"> الحالة : <span>'+v.status+'</span></div> ';
                    html += '</div> ';
                    html += '<div class="another-details">';
                    html += '<div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> '+v.name1+' ,  '+v.name2+' </div>';
                    html += '<div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> '+jQuery.format.prettyDate(v.created_at)+'</div>';
                    html += '<div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>';
                    html += '<div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :'+v.bidValue+' $</div>';
                    html +='<div class="imp-button">';

                    html +='<a href="<?= lang_url('edit-case').'/' ; ?>'+v.id+'">';
                    html +='<button class="edit">';
                    html +='تعديل';
                    html +='</button>';
                    html +='</a>';
            var onclick_action= 'onclick="return confirm(\'Are you sure you want to  this item?\')"';
                    
                    html +='<a href="{{lang_url('delete-case').'/'}} '+v.id+'"'+onclick_action+ '>';
                    html +='<button class="delt">';
                    html +='مسح';
                    html +='</button>';
                    html +='</a>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';


















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
