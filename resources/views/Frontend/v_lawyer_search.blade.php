@extends(FEI.'.master')
@section('content')
      <!--*******************************************************************-->
  <div class="lawyers-img">
       <p>   نتيجة بحثك</p>
      </div> 


<!--***********************************************************************-->

<section class="lawyers wrapper">
<div class="container">
<div class="row">

<form method="get" role="search" action="{{lang_url('lawyers/search')}}">
  {{ csrf_field() }}
<div class="forsearch">
<label> البحث </label>
<input type="search" name="q" class="form-control" value="{{$query}}">
<button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
</div>
</form>

<div class="col-md-12">
@if(isset($details))
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
                        <span> 0- {{ $details->total() }} </span>
                        {{trans('cpanel.of')}}
                        <span> {{$details->total()}} </span>{{trans('cpanel.result')}}
                     </p>
                     <div id='page_navigation'>{{ $details->links() }}</div>
                  </div>
@endif 


<input type='hidden' id='current_page' />
<input type='hidden' id='show_per_page' />	    

<div id='content'>

@if(isset($details))
       

@foreach($details as $value)

<div class="col-md-3 col-xs-6 text-center">
<a href="{{lang_url('lawyer').'/'.$value->id}}">    
<div class="pro">
<img src="{{ asset('public/uploads/user_img')}}/{{$value->image}}" class="img-responsive img-circle">
<h3> {{$value->name}}</h3>    
<p>{{$value->career}} </p>    
</div>   
</a>    
</div>     
@endforeach 
@elseif(isset($message))
         <p>{{ $message }}</p>
         @endif 

</div>	    
</div>    

<!--***********************************************-->    




</div>    
</div>    
</section>

<div id='page_navigation'></div>	



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
            $('body #sort ,body #max ,body #low').each(function(){
                $(this).on('change click', function(){
                if($(this).attr('id') == 'max'){
                    sortBy = $(this).attr('id');
                  }
                  if($(this).attr('id') == 'low'){
                    sortBy = $(this).attr('id');
                  }


            filters = {'sortBy':sortBy,'q':'{{ $query }}'} ;

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
              url: "{!! lang_url('lawyers/searchFiltering') !!}"+page,
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
                    html +='<div class="col-md-3 col-xs-6 text-center">';
                    html += '<a href="<?= lang_url('lawyer').'/' ; ?>'+v.id+'">';
                    html += '<div class="pro">';
                    html += '<img src="{{ asset('public/uploads')}}/avater.png" class="img-responsive">';
                
                    html += '<h3>'+v.username+'</h3>';
                    html += '<p>'+v.usercareer+'</p>';
                    html += '</div> ';
                    html += '</a>';
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