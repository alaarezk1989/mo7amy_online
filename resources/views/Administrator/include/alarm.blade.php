@if(Session::has('error_msg'))
<div class="alert alert-danger">
    <button class="close" data-close="alert"></button> {{ session()->get('error_msg') }}
</div>
@endif

@if(Session::has('success_msg'))
<div class="alert alert-success">
	<button class="close" data-close="alert"></button> {{ session()->get('success_msg') }}
</div>
@endif