<aside>
    <nav>
        @if(auth()->user()->permissions == 'admin')
        <a href="{{ url('question') }}" class="{{ (Request::is('question')) ? 'active-tab' :'' }}"><span class="sm sm-generator"></span>generator</a>
        <a href="{{ url('collectives') }}" class="{{ (Request::is('collectives')) ? 'active-tab' :'' }}"><span class="sm sm-questions"></span>colls</a>
        <a href="{{ url('admins') }}" class="{{ (Request::is('admins')) ? 'active-tab' :'' }}"><span class="sm sm-users"></span>show_admin</a>
        <a href="{{ url('translations') }}" class="{{ (Request::is('translations')) ? 'active-tab' :'' }}"><span class="sm sm-translations"></span>translations</a>
        @endif
    </nav>
</aside>
