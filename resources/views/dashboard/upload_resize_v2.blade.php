
@extends('template')
@section('page_title')
@lang('messages.Image.Upload/Resize Image')
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.Image.Upload/Resize Image')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="iframe" class="embed-responsive-item" src="{{url('JIC/index')}}"></iframe>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop




@section('script')
    <script>
        $('#images').addClass('active');
        $('#upload_resize_v2').addClass('active');
    </script>
@stop
