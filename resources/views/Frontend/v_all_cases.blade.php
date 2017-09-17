@extends(FEI.'.master')
@section('content')
<?php
use Carbon\Carbon;
$locale = App::getLocale();
?>
<!--*******************************************************************-->


<div class="cases-img">
<p> القضايا المعروضة </p>
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
                        <span id="total_per_page">  </span> {{trans('cpanel.result')}}
                     </p>
                     <div id='page_navigation'>{{ $all_cases->links() }}</div>
                  </div>


<input type='hidden' id='current_page' />
<input type='hidden' id='show_per_page' />

<div id='content' >








</div>
</div>

<!--***********************************************-->



<div class="col-md-4">



<div class="sidebar2">


<form method="get" role="search" action="{{lang_url('cases/search')}}">
  {{ csrf_field() }}
<div class="forsearch">
<label> البحث </label>
<input type="search" name="q" class="form-control" placeholder="ابحث عن ">
<button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
</div>
</form>

<form method="get" action="{{lang_url('cases/filtering')}}">



<div id="filters2" class="dep">
<div class="filterblock2" id="all_sections">
<label> الاقسام </label>
<input type="checkbox" id="filter" class="AllSections filter sections" >  الكل <br>
  <?php
         foreach($sections as $key => $value){?>
               <input id="filter" class="filter sections"  type="checkbox"  value="{{$key}}" data-tag="{{$value}}"  /> {{$value}} <br>
            <?php }?>
</div>
</div>

<div  id="filters2" class="count">
<div class="filterblock2" id="all_countries">
<label> الدول </label>
                <input type="checkbox" id="filter" class="AllCountries filter countries" >  الكل <br>
  <?php
         foreach($countries as $key => $value){?>
               <input  type="checkbox" id="filter" class="filter countries"  value="{{$key}}" data-tag="{{$value}}"  /> {{$value}} <br>
            <?php }?>
</div>
</div>


<div class="case" id="all_status2">
<label> الحالة </label>
<input   type="checkbox" id="filter" class="AllStatus2 filter status2">  الكل <br>
<input id="filter" class="filter status2" type="checkbox"  value="1"> المتاح   <br>
<input id="filter" class="filter status2" type="checkbox"  value="0" > المنتهى    <br>
<!--<input id="filter" class="filter status" type="checkbox" name="" value="" > تحت التنفيذ    <br>
!--></div>


<div class="timee">
<label> المدة الزمنية </label>
<input type="checkbox" name="" value="">  الكل <br>
<input id="filter" class="filter created_date" type="checkbox"  value=""> اخر 6 ساعات <br>
<input id="filter" class="filter created_date" type="checkbox"  value="" > اخر 12 ساعة  <br>
<input id="filter" class="filter created_date" type="checkbox"  value="" > اخر 24 ساعة <br>
<input id="filter" class="filter created_date" type="checkbox"  value="" > اخر 7 اسبوع  <br>
<input id="filter" class="filter created_date" type="checkbox"  value="" > اخر شهر  <br>

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
      <script >


      </script>


      <script>

            var sections = [];
            var countries = [];
            var filters = [] ;
            var Case_status2 = [] ;
            var created_date = [] ;
            var html = '' ;
            //  Call the ajax request
            getData();

            // Select all
            allOf_filterationSections();



          $(document).ready(function(){

          // $('.loader').hide();
            $('.filter').on('change', function(){
               // $('.loader').show();
              var category_list = [];
              $('body #filter').each(function(){

                if($(this).is(":checked")) {

                    if($(this).hasClass( "countries" )){
                        if($(this).val()){
                            countries.push($(this).val());
                            countries = $.unique(countries);
                        }

                    }

                    if($(this).hasClass( "sections" )){
                        if($(this).val()){
                            sections.push($(this).val());

                            sections = $.unique(sections);
                        }
                    }

                    if($(this).hasClass( "status2" )){
                        if($(this).val()){
                            Case_status2.push($(this).val());
                            Case_status2 = $.unique(Case_status2);
                        }
                    }

                        if($(this).hasClass( "created_date" )){
                        if($(this).val()){
                            created_date.push($(this).val());
                            created_date = $.unique(created_date);
                        }
                    }
                }

              });

            filters = {'countries':countries,'sections':sections , 'status2':Case_status2, 'created_date':created_date} ;

            //  Call the ajax request
              
        var page_url = $('.active_page').html(); 
        // alert(page_url);
                getData(page_url);


                 html = '' ;
                 sections = [];
                 countries = [];
                 // filters = [] ;
                 Case_status2 = [] ;

               created_date = [] ;

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
              url: "{!! lang_url('cases/filtering') !!}"+page,
              data: filters,
              success: function(result){
                console.log(result);
              html='';
              var total_per_page=result.data['total'];
             // console.log(total_per_page);
              $('#total_per_page').text(total_per_page);
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
                    html += '<a href="<?= lang_url('case').'/' ; ?>'+v.id+'">';
                    html += '<div class="case-client border-bott">';
                    html += '<p>'+v.title+'</p>  ';
                    html += '<div> ';
                    html += '<div class="casetype"> نوع القضية : <span>'+v.SectionName+'</span></div>';
                    html += '<div class="status"> الحالة : <span>'+v.status+'</span></div> ';
                    html += '</div> ';
                    html += '<div class="another-details">';
                    html += '<div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> '+v.CountryName+' ,  '+v.Cityname+' </div>';
                    html += '<div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> '+jQuery.format.prettyDate(v.created_at)+'</div>';
                    html += '<div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>';
                    html += '<div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :'+v.bidValue+' $</div>';
                    html += '</div> </div>';
                    html += '</a>';


                });
                $('#content').html(html);
              // $('.loader').hide();
                //

              }
            });

          }


          function allOf_filterationSections(){
           /* $('#AllSections').change(function(){
                $('.filter').each(function(){
                    if($(this).hasClass('sections')){
                        $(this).trigger('click');
                    }
              });
            });
*/

            // $('#AllCountries').change(function(){
            //     $('.filter').each(function(){
            //         if($(this).hasClass('countries')){
            //            // $(this).trigger('click');
            //         }
            //   });
            // });

              $(".AllCountries").click(function () {
                if ($('input.AllCountries').is(':checked')) {
                   // alert('x1');
                    $("#all_countries input[type=checkbox]").each(function () {
                      $(this).prop("checked", true);
                    });
                } else {
                    $("#all_countries input[type=checkbox]").each(function () {
                       $(this).prop("checked", false);
                    });
                }
            });

   $(".AllSections").click(function () {
                if ($('input.AllSections').is(':checked')) {
                   // alert('x1');
                    $("#all_sections input[type=checkbox]").each(function () {
                      $(this).prop("checked", true);
                    });
                } else {
                    $("#all_sections input[type=checkbox]").each(function () {
                       $(this).prop("checked", false);
                    });
                }
            });



   $(".AllStatus2").click(function () {
                if ($('input.AllStatus2').is(':checked')) {
                   // alert('x1');
                    $("#all_status2 input[type=checkbox]").each(function () {
                      $(this).prop("checked", true);
                    });
                } else {
                    $("#all_status2 input[type=checkbox]").each(function () {
                       $(this).prop("checked", false);
                    });
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
