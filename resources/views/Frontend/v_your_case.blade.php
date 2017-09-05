@extends(FEI.'.master')
@section('content')
<div class="container-fluid head-off">
<div class="row">
<img src="{{ URL::to('public/assets/Frontend/img/Client%20Cases%20Page%20Image.png') }}" class="img-responsive">
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
<p> يظهر <spa> 0- 8 </spa> من <span> 25 </span>  نتيجة  </p> 

<div id='page_navigation'></div>	

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
<p> {{$value->title}}</p>
<div>   
<div class="casetype"> نوع القضية : <span>{{$value->type}}</span></div>    
<div class="status"> الحالة :                    <?php
                         if($value->status ==1) echo '<span> متاح</span>';
                         else{echo '</span>غير متاحة</span>'; }
                              ?></div>   
</div> 
<div class="another-details">
<div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>   
<div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>    
<div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>    
<div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div> 
<div class="imp-button">
<!--<button data-target="#deletetvideo" data-toggle="modal" class="delt"> مسح </button>         

<button data-toggle="modal" data-target="#editvideo" class="edit"> تعديل </button>      
-->
<a href="{{lang_url('edit-case').'/'.$value->id}}">
<button class="btn btn-primary">تعديل</button>
</a>
<a href="{{lang_url('delete-case').'/'.$value->id}}"
<button class="btn btn-danger">مسح</button></a>
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
