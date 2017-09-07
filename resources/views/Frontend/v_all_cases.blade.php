@extends(FEI.'.master')
@section('content')
<?php
use Carbon\Carbon;
$locale = App::getLocale();
?>
<!--*******************************************************************-->
<style>
.cssload-thecube {
    width: 73px;
    height: 73px;
    margin: 0 auto;
    margin-top: 49px;
    position: relative;
    transform: rotateZ(45deg);
        -o-transform: rotateZ(45deg);
        -ms-transform: rotateZ(45deg);
        -webkit-transform: rotateZ(45deg);
        -moz-transform: rotateZ(45deg);
}
.cssload-thecube .cssload-cube {
    position: relative;
    transform: rotateZ(45deg);
        -o-transform: rotateZ(45deg);
        -ms-transform: rotateZ(45deg);
        -webkit-transform: rotateZ(45deg);
        -moz-transform: rotateZ(45deg);
}
.cssload-thecube .cssload-cube {
    float: left;
    width: 50%;
    height: 50%;
    position: relative;
    transform: scale(1.1);
        -o-transform: scale(1.1);
        -ms-transform: scale(1.1);
        -webkit-transform: scale(1.1);
        -moz-transform: scale(1.1);
}
.cssload-thecube .cssload-cube:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgb(43,160,199);
    animation: cssload-fold-thecube 2.76s infinite linear both;
        -o-animation: cssload-fold-thecube 2.76s infinite linear both;
        -ms-animation: cssload-fold-thecube 2.76s infinite linear both;
        -webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
        -moz-animation: cssload-fold-thecube 2.76s infinite linear both;
    transform-origin: 100% 100%;
        -o-transform-origin: 100% 100%;
        -ms-transform-origin: 100% 100%;
        -webkit-transform-origin: 100% 100%;
        -moz-transform-origin: 100% 100%;
}
.cssload-thecube .cssload-c2 {
    transform: scale(1.1) rotateZ(90deg);
        -o-transform: scale(1.1) rotateZ(90deg);
        -ms-transform: scale(1.1) rotateZ(90deg);
        -webkit-transform: scale(1.1) rotateZ(90deg);
        -moz-transform: scale(1.1) rotateZ(90deg);
}
.cssload-thecube .cssload-c3 {
    transform: scale(1.1) rotateZ(180deg);
        -o-transform: scale(1.1) rotateZ(180deg);
        -ms-transform: scale(1.1) rotateZ(180deg);
        -webkit-transform: scale(1.1) rotateZ(180deg);
        -moz-transform: scale(1.1) rotateZ(180deg);
}
.cssload-thecube .cssload-c4 {
    transform: scale(1.1) rotateZ(270deg);
        -o-transform: scale(1.1) rotateZ(270deg);
        -ms-transform: scale(1.1) rotateZ(270deg);
        -webkit-transform: scale(1.1) rotateZ(270deg);
        -moz-transform: scale(1.1) rotateZ(270deg);
}
.cssload-thecube .cssload-c2:before {
    animation-delay: 0.35s;
        -o-animation-delay: 0.35s;
        -ms-animation-delay: 0.35s;
        -webkit-animation-delay: 0.35s;
        -moz-animation-delay: 0.35s;
}
.cssload-thecube .cssload-c3:before {
    animation-delay: 0.69s;
        -o-animation-delay: 0.69s;
        -ms-animation-delay: 0.69s;
        -webkit-animation-delay: 0.69s;
        -moz-animation-delay: 0.69s;
}
.cssload-thecube .cssload-c4:before {
    animation-delay: 1.04s;
        -o-animation-delay: 1.04s;
        -ms-animation-delay: 1.04s;
        -webkit-animation-delay: 1.04s;
        -moz-animation-delay: 1.04s;
}



@keyframes cssload-fold-thecube {
    0%, 10% {
        transform: perspective(136px) rotateX(-180deg);
        opacity: 0;
    }
    25%,
                75% {
        transform: perspective(136px) rotateX(0deg);
        opacity: 1;
    }
    90%,
                100% {
        transform: perspective(136px) rotateY(180deg);
        opacity: 0;
    }
}

@-o-keyframes cssload-fold-thecube {
    0%, 10% {
        -o-transform: perspective(136px) rotateX(-180deg);
        opacity: 0;
    }
    25%,
                75% {
        -o-transform: perspective(136px) rotateX(0deg);
        opacity: 1;
    }
    90%,
                100% {
        -o-transform: perspective(136px) rotateY(180deg);
        opacity: 0;
    }
}

@-ms-keyframes cssload-fold-thecube {
    0%, 10% {
        -ms-transform: perspective(136px) rotateX(-180deg);
        opacity: 0;
    }
    25%,
                75% {
        -ms-transform: perspective(136px) rotateX(0deg);
        opacity: 1;
    }
    90%,
                100% {
        -ms-transform: perspective(136px) rotateY(180deg);
        opacity: 0;
    }
}

@-webkit-keyframes cssload-fold-thecube {
    0%, 10% {
        -webkit-transform: perspective(136px) rotateX(-180deg);
        opacity: 0;
    }
    25%,
                75% {
        -webkit-transform: perspective(136px) rotateX(0deg);
        opacity: 1;
    }
    90%,
                100% {
        -webkit-transform: perspective(136px) rotateY(180deg);
        opacity: 0;
    }
}

@-moz-keyframes cssload-fold-thecube {
    0%, 10% {
        -moz-transform: perspective(136px) rotateX(-180deg);
        opacity: 0;
    }
    25%,
                75% {
        -moz-transform: perspective(136px) rotateX(0deg);
        opacity: 1;
    }
    90%,
                100% {
        -moz-transform: perspective(136px) rotateY(180deg);
        opacity: 0;
    }
}
</style>


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
                        <span> 0- {{ $all_cases->perPage() }} </span>
                        {{trans('cpanel.of')}}
                        <span> {{$all_cases->total()}} </span>{{trans('cpanel.result')}}
                     </p>
                     <div id='page_navigation'>{{ $all_cases->links() }}</div>
                  </div>


<input type='hidden' id='current_page' />
<input type='hidden' id='show_per_page' />	    

<div id='content' >
	

<div class="cssload-thecube loader">
    <div class="cssload-cube cssload-c1"></div>
    <div class="cssload-cube cssload-c2"></div>
    <div class="cssload-cube cssload-c4"></div>
    <div class="cssload-cube cssload-c3"></div>
</div>





</div>	    
</div>    

<!--***********************************************-->    



<div class="col-md-4">
<div class="sidebar2">

<form method="get" action="{{url('/cases/filtering')}}">

<div class="forsearch">
<label> البحث </label>    
<input type="search" class="form-control" placeholder="ابحث عن ">  
<button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>    
</div>    

<div id="filters" class="dep">
<div class="filterblock">
<label> الاقسام </label>  
<input type="checkbox" name="" value="">  الكل <br>  
  <?php
         foreach($specialty as $key => $value){?>
               <input id="filter" class="filter types"  type="checkbox"  value="{{$key}}" data-tag="{{$value}}"  /> {{$value}} <br> 
            <?php }?>
</div>
</div>

<div  id="filters2" class="count">
<div class="filterblock2">
<label> الدول </label> 
<input type="checkbox" name="" value="">  الكل <br>    
  <?php
         foreach($countries as $key => $value){?>
               <input id="filter" class="filter countries"  type="checkbox"  value="{{$key}}" data-tag="{{$value}}"  /> {{$value}} <br> 
            <?php }?>
</div>  
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
     


      <script>
            var types = [];
            var countries = [];
            var filters = [] ;
            var url = "<?= url('/filtering') ?>";



          $(document).ready(function(){
            
            $('.loader').hide();
            $('.filter').on('change', function(){
                $('.loader').show();
              var category_list = [];
              $('body #filter').each(function(){
                
                if($(this).is(":checked")) {

                    if($(this).hasClass( "countries" )){
                        if($(this).val()){
                            countries.push($(this).val());
                            countries = $.unique(countries);
                        }
                        
                    }
                    
                    if($(this).hasClass( "types" )){
                        if($(this).val()){
                            types.push($(this).val());

                            types = $.unique(types);
                        }
                    }
                }/*else{
                    if($(this).hasClass( "countries" )){
                        if($(this).val()){
                            countries.splice($(this).val());
                            countries = $.unique(countries);
                        }
                        
                    }
                    
                    if($(this).hasClass( "types" )){
                        if($(this).val()){
                            types.splice($(this).val());
                            types = $.unique(types);
                        }
                    }
                }*/
               
              });


            console.log(countries);
            console.log(types);
            filters = {'countries':countries,'types':types} ;
            var html = '' ;
            $.ajax({
              type: "GET",
              url: "http://localhost/mo7amy_online/ar/cases/filtering",
              data: filters,
              success: function(data){
                $.each(data.data,function(k,v){
                    html += '<div class="case-client border-bott">';
                    html += '<p>'+v.title+'</p>  ';
                    html += '<div> ';
                    html += '<div class="casetype"> نوع القضية : <span>'+v.type+'</span></div>';
                    html += '<div class="status"> الحالة : <span>'+v.status+'</span></div> ';
                    html += '</div> ';
                    html += '<div class="another-details">';
                    html += '<div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> '+v.country+' ,  '+v.city+' </div>';
                    html += '<div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>';
                    html += '<div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>';
                    html += '<div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>';
                    html += '</div> </div>';


                });
            
                $('#content').html(html);
                $('.loader').hide();
                //
                 html = '' ;
                 types = [];
                 countries = [];
                 filters = [] ;
              }
            });



              if(category_list.length == 0)
                $('.resultblock').fadeIn();
              else {
                $('.resultblock').each(function(){
                  var item = $(this).attr('data-tag');
                  if(jQuery.inArray(item,category_list) > -1)
                    $(this).fadeIn('slow');
                  else
                    $(this).hide();
                });
              }   
            });
          }); 
        </script>
        <script>
          $(document).ready(function(){
            $('.country').on('change', function(){
              var category_list = [];
              $('#filters2 :input:checked').each(function(){
                var category = $(this).val();
                category_list.push(category);
              });

              if(category_list.length == 0)
                $('.resultblock').fadeIn();
              else {
                $('.resultblock').each(function(){
                  var item = $(this).attr('id');
                  if(jQuery.inArray(item,category_list) > -1)
                    $(this).fadeIn('slow');
                  else
                    $(this).hide();
                });
              }   
            });
          }); 
        </script>
















     
      @stop
