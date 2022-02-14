@extends('template')
@section('page_title')
@lang('messages.sliders.create_slider')
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.sliders.create_slider') </h3>
                </div>
                <div class="box-content">
                    @if($slider)
                    {!! Form::model($slider,["url"=>"slider/$slider->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('slider.input',['buttonAction'=>''.\Lang::get("messages.Edit").'','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"slider","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('slider.input',['buttonAction'=>''.\Lang::get("messages.save").'','required'=>'  *'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@stop
@section('script')
    <script>
        $('#slider').addClass('active');
        $('#slider_create').addClass('active');
    </script>
@stop
