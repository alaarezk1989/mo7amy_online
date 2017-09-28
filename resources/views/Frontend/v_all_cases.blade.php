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
                           <li><a id="max"href="#">{{ trans('cpanel.highest_price') }}</a></li>
                           <li><a id="low"href="#">{{ trans('cpanel.lowest_price') }}</a></li>
                           <li><a id="latest"href="#">{{ trans('cpanel.latest_show') }} </a></li>
                        </ul>
                     </div>
                     <p>
                       {{trans('cpanel.show')}}
                        <span> 0- {{ $all_cases->perPage() }} </span>
                        {{trans('cpanel.of')}}
                        <span id="total_per_page">  </span> {{trans('cpanel.result')}}
                     </p>
                     <div id='page_navigation' class="test">{{ $all_cases->links() }}</div>
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

<?php
$get_section = 0;
$get_country = 0;

if(isset($_GET['section'])){
$get_section = $_GET['section'];
}

if(isset($_GET['country'])){
$get_country = $_GET['country'];
}
?>
<input type="hidden" value="<?php echo $get_section; ?>" id="get_section">
<input type="hidden" value="<?php echo $get_country; ?>" id="get_country">


<form method="get" action="{{lang_url('cases/filtering')}}">

<div id="filters2" class="dep">
<div class="filterblock2" id="all_sections">
<label> الاقسام </label>
<input type="checkbox" id="filter" class="AllSections filter sections" >  الكل <br>
  <?php
         foreach($sections as $key => $value){
          $checked ='';
            if($get_section == $key){
              $checked = "checked = 'checked'";
            }
          ?>
               <input id="filter" class="filter sections"  type="checkbox" {{$checked}} value="{{$key}}" data-tag="{{$value}}"  /> {{$value}} <br>
            <?php }?>
</div>
</div>

<div  id="filters2" class="count">
<div class="filterblock2" id="all_countries">
<label> الدول </label>
                <input type="checkbox" id="filter" class="AllCountries filter countries" >  الكل <br>
  <?php
         foreach($countries as $key => $value){
            $checked ='';
            if($get_country == $key){
              $checked = "checked = 'checked'";
            }
          ?>

                         <input  type="checkbox" id="filter" class="filter countries" {{$checked}} value="{{$key}}" data-tag="{{$value}}"  /> {{$value}} <br>
            <?php }?>
</div>
</div>


<div class="case" id="all_status2">
<label> الحالة </label>
<input   type="checkbox" id="filter" class="AllStatus2 filter status2">  الكل <br>
<input id="filter" class="filter status2" type="checkbox"  value="1"> المتاح   <br>
<input id="filter" class="filter status2" type="checkbox"  value="0" > المنتهى    <br>
<input id="filter" class="filter status2" type="checkbox"  value="2" > تحت التنفيذ    <br>
</div>












<div class="timee">
<label> المدة الزمنية </label>
<input type="checkbox" name="" value="">  الكل <br>
<input id="filter" class="filter created_date" type="checkbox"  value="6"> اخر 6 ساعات <br>
<input id="filter" class="filter created_date" type="checkbox"  value="12" > اخر 12 ساعة  <br>
<input id="filter" class="filter created_date" type="checkbox"  value="24" > اخر 24 ساعة <br>
<input id="filter" class="filter created_date" type="checkbox"  value="7" > اخر 7 ايام <br>
<input id="filter" class="filter created_date" type="checkbox"  value="30" > اخر شهر  <br>

</div>


</form>
</div>
</div>



</div>
</div>
</section>


<!--*******************************************-->


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <script >


      </script>


      <script>

            var sections = [];
            var countries = [];
            var filters = [] ;
            var Case_status2 = [] ;
            var created_date = '' ;
            var sortBy = '' ;
            var html = '' ;
            //  Call the ajax request
            getData();

            // Select all
            allOf_filterationSections();

          $(document).ready(function(){

            /*This part to make sections and countries at home page */
     var get_section = $('#get_section').val();
     var get_country = $('#get_country').val();

        if(get_section>0){
        sections.push(get_section);
         filters = {'sections':sections};
         var page_url = $('.active_page').html();
        // alert(page_url);
                getData(page_url);
            }
        if(get_country>0){
        countries.push(get_country);
         filters = {'countries':countries};
         var page_url = $('.active_page').html();
        // alert(page_url);
                getData(page_url);
            }
/*This part to make sections and countries at home page */

            filterIt() ;


          });

          function filterIt(){
              // $('.loader').hide();
            $('body .filter ,body #sort ,body #max ,body #low ,body #latest').each(function(){
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
                            created_date =$(this).val();
                        }
                    }
                }

              });

            filters = {'countries':countries,'sections':sections , 'status2':Case_status2, 'created_date':created_date , 'sortBy':sortBy} ;

            //  Call the ajax request

        var page_url = $('.active_page').html();
        // alert(page_url);
                getData(page_url);


                 html = '' ;
                 sections = [];
                 countries = [];
                 // filters = [] ;
                 Case_status2 = [] ;

               created_date = '' ;

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
              url: "{!! lang_url('cases/filtering') !!}"+page,
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
                    if(v.status == 1){
                        v.status = "متاح" ;
                    }if(v.status == 2){
                        v.status = "تحت التنفيذ" ;
                    }
                    else{
                        v.status = "غير متاح" ;
                    }

                    if(v.bidValue == null){
                        v.bidValue = "0" ;
                    }else{
                        v.bidValue =  v.bidValue ;
                    }
                    html += '<a href="<?= lang_url('case').'/' ; ?>'+v.id+'">';
                    html += '<div class="case-client">';
                    html += '<p>'+v.title+'</p>  ';
                    html += '<div> ';
                    html += '<div class="casetype"> نوع القضية : <span>'+v.SectionName+'</span></div>';
                    html += '<div class="status"> الحالة : <span>'+v.status+'</span></div> ';
                    html += '</div> ';
                    html += '<div class="another-details">';
                    html += '<div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> '+v.CountryName+' ,  '+v.Cityname+' </div>';
                    html += '<div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> '+v.created_at+'</div>';
                    html += '<div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>'+v.finished_date+'</div>';
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
