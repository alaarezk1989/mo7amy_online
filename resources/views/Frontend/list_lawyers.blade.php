@extends(FEI.'.master')
@section('content')

      <!--*******************************************************************-->
      <div class="lawyers-img">
      <p>  قائمة المستشارين </p>
      </div>

      <!--***********************************************************************-->
      <section class="lawyers">
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
                           <li><a id="max" href="#">الترتيب تصاعديا</a></li>
                           <li><a id="low" href="#">الترتيب تنازليا</a></li>

                        </ul>
                     </div>
                     <p>
                       {{trans('cpanel.show')}}
                        <span> 0- {{ $all_lawyers->perPage() }} </span>
                        {{trans('cpanel.of')}}
                        <span id="total_per_page"> </span>{{trans('cpanel.result')}}
                     </p>
                     <div id='page_navigation'>{{ $all_lawyers->links() }}</div>
                  </div>
                  <input type='hidden' id='current_page' />
                  <input type='hidden' id='show_per_page' />

                  <div id='content'>


                  </div>
               </div>
               <!--***********************************************-->
               <div class="col-md-4">
                  <div class="sidebar2">

<form method="get" role="search" action="{{lang_url('lawyers/search')}}">
  {{ csrf_field() }}
<div class="forsearch">
<label> البحث </label>
<input type="search" name="q" class="form-control" placeholder="ابحث عن ">
<button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
</div>
</form>

                     <form method="get" action="{{url('lawyers/filtering')}}">

                      <div id="filters" class="dep">
                         <div class="filterblock" id="all_sections">
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

            var sections = [];
            var countries = [];
            var filters = [] ;
            var sortBy = '' ;
            var html = '' ;
            //  Call the ajax request
            getData();

            // Select all
            allOf_filterationSections();





  $(document).ready(function(){

            filterIt() ;
          });

          function filterIt(){
              // $('.loader').hide();
            $('body .filter ,body #sort ,body #max ,body #low').each(function(){
                $(this).on('change click', function(){
                if($(this).attr('id') == 'max'){
                    sortBy = $(this).attr('id');
                  }
                    if($(this).attr('id') == 'low'){
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


                }

              });

            filters = {'countries':countries,'sections':sections ,'sortBy':sortBy} ;

            //  Call the ajax request

        var page_url = $('.active_page').html();
        // alert(page_url);
                getData(page_url);


                 html = '' ;
                 sections = [];
                 countries = [];
                 // filters = [] ;



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
            $.ajax({
              type: "GET",
              url: "{{lang_url('lawyers/filtering')}}"+page,
              data: filters,
              success: function(result){
                   console.log(result);
              html='';
              var total_per_page=result.data['total'];
              $('#total_per_page').text(total_per_page);

              var last_page=result.data['last_page'];
              $('#page_navigation').find('a').each(function() {
                  // console.log($(this).attr('href'));
                   page_link=$(this).text();
                   if(page_link > last_page){
                     $(this).hide();
                   }
                    // alert('mmss'+$(this).text());
              });
              
                $.each(result.data.data,function(k,v){

                    html += '<div class="col-md-3 col-xs-6 text-center">'
                    html += '<a href="<?= lang_url('lawyer').'/' ; ?>'+v.id+'">';
                    html += '<div class="pro">';
                    html += '<img src="{{ asset('public/uploads/user_img').'/'}}'+v.image+'" class="img-responsive img-circle">';
                    html += '<h3>'+v.name+'</h3>';
                   // html += '<h3>'+v.s_name+'</h3>';
                    html += '<h4>'+v.career+'</h4>';
                    html += '</div> ';
                     html += '</a>';
                    html += '</div>';
       });

                $('#content').html(html);
              // $('.loader').hide();
                //

              }
            });

          }


          function allOf_filterationSections(){


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
