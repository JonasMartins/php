@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Success&nbsp;</strong>{{session('success')}}
</div>
@endif