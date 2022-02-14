@if (Session::has('success'))
    <br>
    <div class="alert alert-success {{ Session::has('important_msg') ? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('success') }}
    </div>
@elseif(Session::has('failed'))
    <br>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('failed') }}
    </div>
@endif

@if (session('status'))
    <br>
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
