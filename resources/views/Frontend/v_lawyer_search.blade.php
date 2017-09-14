@extends(FEI.'.master')
@section('content')
<div class="container-fluid ">
<div class="row">
<img src="img/Cases%20Page%20Image.png" class="img-responsive">      
</div>        
</div>    


<!--***********************************************************************-->

<section class="offers">
<div class="container">
<div class="row">

<div class="col-md-8">

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


<input type='hidden' id='current_page' />
<input type='hidden' id='show_per_page' />	    

<div id='content'>



<div class="case-client border-bott">
<p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>  
<div>   
<div class="casetype"> نوع القضية : <span>جنائية</span></div>    
<div class="status"> الحالة : <span>متاح</span></div>    
</div> 
<div class="another-details">
<div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>   
<div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>    
<div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>    
<div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div> 
</div> 
</div>  





</div>	    
</div>    

<!--***********************************************-->    



<div class="col-md-4">
<div class="sidebar2">

<form>

<div class="forsearch">
<label> البحث </label>    
<input type="search" class="form-control" placeholder="ابحث عن ">  
<button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>    
</div>    

<div class="dep">
<label> الاقسام </label>    
<input type="checkbox" name="" value="">  الكل <br>
<input type="checkbox" name="" value=""> تجارية  <br>
<input type="checkbox" name="" value="" > مالية   <br>
<input type="checkbox" name="" value="" > عقارية   <br>
<input type="checkbox" name="" value="" > طبية   <br>
<input type="checkbox" name="" value="" > زوجية   <br>
<input type="checkbox" name="" value="" > اسرية   <br>
<input type="checkbox" name="" value="" > عمالية  <br>
<input type="checkbox" name="" value="" > ادارية  <br>
<input type="checkbox" name="" value="" > عسكرية   <br>
</div>

<div class="count">
<label> الدول </label>    
<input type="checkbox" name="" value="">  الكل <br>
<input type="checkbox" name="" value=""> الامارات   <br>
<input type="checkbox" name="" value="" > السعودية    <br>
<input type="checkbox" name="" value="" > قطر    <br>
<input type="checkbox" name="" value="" > البحرين   <br>
<input type="checkbox" name="" value="" > الكويت   <br>
<input type="checkbox" name="" value="" > مصر    <br>
<input type="checkbox" name="" value="" > تونس  <br>
<input type="checkbox" name="" value="" > المغرب  <br>
</div>    


<div class="case">
<label> الحالة </label>    
<input type="checkbox" name="" value="">  الكل <br>
<input type="checkbox" name="" value=""> المتاح   <br>
<input type="checkbox" name="" value="" > المنتهى    <br>
<input type="checkbox" name="" value="" > تحت التنفيذ    <br>
</div>   


<div class="timee">
<label> المدة الزمنية </label>    
<input type="checkbox" name="" value="">  الكل <br>
<input type="checkbox" name="" value=""> اخر 6 ساعات <br>
<input type="checkbox" name="" value="" > اخر 12 ساعة  <br>
<input type="checkbox" name="" value="" > اخر 24 ساعة <br>
<input type="checkbox" name="" value="" > اخر 7 ساعة  <br>
<input type="checkbox" name="" value="" > اخر شهر  <br>

</div>       


</form>   
</div> 
</div>   



</div>    
</div>    
</section>

<div id='page_navigation'></div>	

@endforeach  


<!--*******************************************-->    