@if (count($error))
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">   
    <strong class="mr-auto">SICC</strong>
    <small class="text-muted">Error</small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
  @foreach($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach
  </div>
</div>
@endif