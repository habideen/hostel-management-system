@if(Session::has('fail'))
  <div class="alert alert-danger">{!!Session::get('fail')!!}</div>
@elseif(Session::has('success'))
  <div class="alert alert-success">{!!Session::get('success')!!}</div>
@endif