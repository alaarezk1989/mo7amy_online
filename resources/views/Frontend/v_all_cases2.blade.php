@extends(FEI.'.master')
@section('content')

<!--*******************************************************************-->

<div class="container-fluid ">
<div class="row">
<img src="{{ URL::to('public/assets/Frontend/img/Cases%20Page%20Image.png') }}" class="img-responsive">      
</div>        
</div>    


<!--***********************************************************************-->

<section class="offers">
<div class="container">
<div class="row">

<div class="col-md-8">




<input type='hidden' id='current_page' />
<input type='hidden' id='show_per_page' />	    

<div id='content'>
	@if(isset($Cases))
         <p> The Search results for your query <b> {{ $query }} </b> are :</p>
         <h2>Sample User details</h2>


 @foreach($Cases as $value)
<a href="{{lang_url('case').'/'.$value->id}}">
<div class="case-client border-bott">
<p>{{$value->description}}<p>
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
</div> 
</div>   
</a>
  @endforeach

@elseif(isset($message))
         <p>{{ $message }}</p>
         @endif

























    

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




<!--*******************************************--> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <script type="text/javascript">
         $(document).ready(function(){

         //how much items per page to show
         var show_per_page = 8;
         //getting the amount of elements inside content div
         var number_of_items = $('#content').children().size();
         //calculate the number of pages we are going to have
         var number_of_pages = Math.ceil(number_of_items/show_per_page);

         //set the value of our hidden input fields
         $('#current_page').val(0);
         $('#show_per_page').val(show_per_page);

         //now when we got all we need for the navigation let's make it '

         /*
         what are we going to have in the navigation?
         - link to previous page
         - links to specific pages
         - link to next page
         */
         var navigation_html = '<a class="next_link" href="javascript:next();"  aria-label="Next"> <i class="fa fa-chevron-right" aria-hidden="true"></i></a>';
         var current_link = 0;
         while(number_of_pages > current_link){
         navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';
         current_link++;
         }
         navigation_html += '<a class="previous_link" href="javascript:previous();" aria-label="previous"><i class="fa fa-chevron-left" aria-hidden="true"></i> </a>';



         $('#page_navigation').html(navigation_html);

         //add active_page class to the first page link
         $('#page_navigation .page_link:first').addClass('active_page');

         //hide all the elements inside content div
         $('#content').children().css('display', 'none');

         //and show the first n (show_per_page) elements
         $('#content').children().slice(0, show_per_page).css('display', 'block');

         });

         function previous(){

         new_page = parseInt($('#current_page').val()) - 1;
         //if there is an item before the current active link run the function
         if($('.active_page').prev('.page_link').length==true){
         go_to_page(new_page);
         }

         }

         function next(){
         new_page = parseInt($('#current_page').val()) + 1;
         //if there is an item after the current active link run the function
         if($('.active_page').next('.page_link').length==true){
         go_to_page(new_page);
         }

         }
         function go_to_page(page_num){
         //get the number of items shown per page
         var show_per_page = parseInt($('#show_per_page').val());

         //get the element number where to start the slice from
         start_from = page_num * show_per_page;

         //get the element number where to end the slice
         end_on = start_from + show_per_page;

         //hide all children elements of content div, get specific items and show them
         $('#content').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');

         /*get the page link that has longdesc attribute of the current page and add active_page class to it
         and remove that class from previously active page link*/
         $('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');

         //update the current page input field
         $('#current_page').val(page_num);
         }

      </script>

      @stop