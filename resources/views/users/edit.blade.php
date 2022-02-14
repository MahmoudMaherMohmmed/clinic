@extends('template')
@section('page_title')
@lang('messages.users.users')
@stop
@section('content')
@include('errors')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>@lang('messages.users.edit_user')</h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" action="{{url('users/'.$user->id.'/update')}}" method="post">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    {{ csrf_field() }}
                    @include('users.form')
                </form>
            </div>
        </div>
    </div>

</div>

@stop

@section('script')
<script>
    $('#user').addClass('active');
        $('#user-index').addClass('active');
</script>
@stop
