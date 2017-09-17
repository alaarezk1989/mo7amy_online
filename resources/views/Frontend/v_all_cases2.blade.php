@extends(FEI.'.master')
@section('content')
<?php
use Carbon\Carbon;
$locale = App::getLocale();
?>
<div class="cases-img">
 <p>   نتيجة بحثك تكون <b> {{ $query }} </b></p>
</div>

<section class="offers">
<div class="container">
<div class="row">


  









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
<div class="price"><i class="fa fa-money" aria-hidden="true"></i> {{$value->bidValue}} $</div> 

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
