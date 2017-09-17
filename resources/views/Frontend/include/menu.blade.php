<ul class="nav navbar-nav navbar-right main-ul">
  <li class="active"><a href="{{url($locale)}}">{{trans('cpanel.home')}} </a></li>
 <li><a href="{{lang_url('cases')}}">{{trans('cpanel.cases')}}</a></li>

  <li><a href="{{lang_url('lawyers')}}">{{trans('cpanel.lawyers')}}</a></li>
  <li><a href="who%20are%20we.html">{{trans('cpanel.Who_we_are')}}</a></li>
  <li><a href="contact.html">{{trans('cpanel.Contact_us')}}</a></li>
</ul>

<?php

?>
<?php
if($sess_locale=='ar'){
  ?>

  <ul class="nav navbar-nav navbar-right lang">
  <li class="dropdown">
    <a href="{{url('ar')}}" class="dropdown-toggle" data-toggle="dropdown">{{ trans('cpanel.arabic')}}
      <img src="{{ asset('public/assets/'.FE .'/img/ar.png')}}" class="ar">
      <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{url('en')}}"> {{ trans('cpanel.english')}}
          <img src="{{ asset('public/assets/'.FE .'/img/en.png')}}">
        </a>
      </li>
    </ul>
  </li>
  </ul>
<?php
}
?>

<?php
if($sess_locale=='en'){
  ?>
  <ul class="nav navbar-nav navbar-right lang">
    <li class="dropdown">
      <a href="{{url('en')}}" class="dropdown-toggle" data-toggle="dropdown">{{ trans('cpanel.english')}}
        <img src="{{ asset('public/assets/'.FE .'/img/en.png')}}" class="en">
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        <li>
          <a href="{{url('ar')}}"> {{ trans('cpanel.arabic')}}
            <img src="{{ asset('public/assets/'.FE .'/img/ar.png')}}">
          </a>
        </li>
      </ul>
    </li>
  </ul>
<?php
}
?>
