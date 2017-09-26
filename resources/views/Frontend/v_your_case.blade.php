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
                        <span> 0- {{ $your_case->perPage() }} </span>
                        {{trans('cpanel.of')}}
                        <span> {{$your_case->total()}} </span>{{trans('cpanel.result')}}
                     </p>
                     <div id='page_navigation'>{{ $your_case->links() }}</div>
                  </div>










<!--***********************************************-->

<input type='hidden' id='current_page' />
<input type='hidden' id='show_per_page' />	
	@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div id='content'>	




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
<a href="{{lang_url('delete-case').'/'.$value->id}} "onclick="return confirm('Are you sure you want to delete this item?');" >
<button class="delt">مسح</button></a>
</div>  
</div> 
</div>
@endforeach  




 





    



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




 @stop

<!--*******************************************-->    
