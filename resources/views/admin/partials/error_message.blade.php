@if(Session::has('error_message'))
<div class="alert alert-error alert-dismissible show" role="alert">
  <strong>{!! session('error_message') !!}</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
