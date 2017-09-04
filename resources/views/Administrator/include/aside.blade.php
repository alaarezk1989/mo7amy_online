<header>
    <div class="page-wrapper">
      <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button" id="mobile-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <span class="sm sm-menu"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="mobile-menu">
              @if(auth()->user()->permissions == 'admin')
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">nav</li>
              <li><a href="{{ url('admins') }}">admin</a></li>
              @endif
          </ul>
      </div>
        <h1 id="logo">
            <a href="{{ url('/') }}">Lodex</a>
        </h1>
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="main-navigation" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <!-- <span class="dropdown-label">target_generator</span> -->
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="main-navigation">
                <li><a href="{{ url('rtt_question') }}">rtt_generator</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="user-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <img src="{{ asset('public/assets/'.AD .'/global/images/user-avatar.svg')}}">
                <span class="dropdown-label">{{auth()->user()->name}}</span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="user-menu">
                <li><a href="{{url('logout')}}">log_out</a></li>
            </ul>
        </div>
    </div>
</header>
