
<footer class="forindex">
<div class="container">
<div class="row">

<div class="col-md-3 col-sm-3 text-center ul1">
<p>الموقع </p>
<ul class="list-unstyled">
<li> <a href="who%20are%20we.html"> من نحن </a> </li>
<li> <a href=""> هدفنا   </a> </li>
<li> <a href="">  رؤيتنا  </a> </li>
<li> <a href="contact.html">  اتصل نا   </a> </li>
</ul>
</div>

<div class="col-md-3  col-sm-3  text-center ul2">
<P> القضايا </P>
<ul class="list-unstyled">
<li> <a href="addcase-ar.html"> اضف قضية  </a> </li>
<li> <a href="cases.html"> عرض القضايا    </a> </li>
<li> <a href="lawyers.html">  المستشاريين   </a> </li>
<li> <a href="">   ان تكون شركة رائدة  </a> </li>
</ul>
</div>

<div class="col-md-3  col-sm-3  note">
<span> نبذة </span>
<p>خسائر اللازمة ومطالبة حدة بل. الآخر الحلفاء أن غزو, إجلاء وتنامت عدد مع. لقهر معركة لبلجيكا، بـ انهخسائر اللازمة ومطالبة حدة بل. الآخر الحلفاء أن غزو, إجلاء وتنامت عدد مع. لقهر معركة لبلجيكا، بـ انه,</p>
</div>

<div class="col-md-3  col-sm-3  text-center">
<a href="index-ar.html">
  <img src="{{ asset('public/assets/'.FE .'/img/Logo.png')}}" class="logo-footer">  </a>
<ul class="list-unstyled social-links">
<li>  <a href=""><i class="fa fa-facebook"></i> </a> </li>
<li>  <a href=""><i class="fa fa-twitter"></i> </a> </li>
<li>  <a href=""><i class="fa fa-linkedin"></i> </a> </li>
</ul>
</div>


</div>
</div>
</footer>


<div class="container-fluid">
<div class="row">
<p class="last-footer">   جميع الحقوق محفوظة- تم تصميمة وتطويرة بو اسطة  <a href="http://www.lodex-solutions.com">lodex-solutions.com</a> </p>
</div>
</div>

<script>
function initMap() {
var uluru = {lat: 29.961454 , lng: 31.292608};
var map = new google.maps.Map(document.getElementById('map'), {
zoom: 4,
scrollwheel: false,
center: uluru
});
var marker = new google.maps.Marker({
position: uluru,
map: map
});
}
</script>


 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5IUR6CYZb2rgw-8Pu1eUMOinqqq3XN9c&callback=initMap">
</script>

<script src="{{ asset('public/assets/'.FE .'/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('public/assets/'.FE .'/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('public/assets/'.FE .'/js/jquery.nicescroll.min.js')}}"></script>
<script src="{{ asset('public/assets/'.FE .'/js/smooth-scroll.min.js')}}"></script>
<script src="{{ asset('public/assets/'.FE .'/js/jquery-ui.js')}}"></script>
<script src="{{ asset('public/assets/'.FE .'/js/index.js')}}"></script>
<script>
$(document).ready(function() {

    $('#country').on('change', function() {
    // $("body").on('change', '#country', function() {
      var country_id= this.value;
      var req_url = "{!! url('cities_country') !!}"+'/'+country_id;

        $.ajax({
                type: "Get",
                url:req_url,
                data: {country_id: country_id},
                 dataType: 'json', // Define data type will be JSON
                success: function(result) {
                    var cities_data = result.cities_data;
                    var $el = $("#city");
                    $el.empty(); // remove old options
                        cities_data.forEach(function(entry) {
                              $el.append('<option value="'+entry.id+'">'+entry.name+'</option>');
                            });

                },
                error: function(error) {
                    alert( 'ee'+console.log(error));
                $("#ajaxResponse").append("<div>"+error+"</div>");
                }
            }); //end ajax
    }); //end on change country


    $('#bids_button').on('click', function() {
      var bids_val= $('#bids_val').val();
      var case_id=$('#case_id').val();
      // var req_url = "{!! url('set_your_bids') !!}"+'/'+bids_val+'/'+case_id;
      var req_url = "{!! url('set_your_bids') !!}"+'/'+case_id;
        $.ajax({
                type: "post",
                url:req_url,
                // data: {bids_val: bids_val,case_id: case_id},
                data: $('#form_set_bids').serialize(), // Request data in JSON
                 dataType: 'json', // Define data type will be JSON
                success: function(result) {
                    var your_bids_value=result.bids_val;
                    var $el = $("#bids_div");
                    $el.html("  <button><span>{{ trans('cpanel.you_offer') }}</span>" +your_bids_value+" $ </button>"); // remove old options
                    // console.log(result);
                },
                error: function(error) {
                    // alert( 'ee'+console.log(error));
                console.log(error);
                }
            }); //end ajax
              return false;
    }); //end on click on bids
});  //End Document.Ready


$(function() {
    $( "#datepicker" ).datepicker();
         $( "#datepicker" ).datepicker("option", "dateFormat","mm/dd/yy");
 });

</script>


<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{your-app-id}',
      cookie     : true,
      xfbml      : true,
      version    : '{latest-api-version}'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});
</script>

</body>
</html>
