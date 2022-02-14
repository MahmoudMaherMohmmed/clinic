@extends('template')
@section('page_title')
@lang('messages.home_sliders.create_home_slider')
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.home_sliders.create_home_slider') </h3>
                </div>
                <div class="box-content">
                    @if($home_slider)
                    {!! Form::model($home_slider,["url"=>"home_slider/$home_slider->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('home_slider.input',['buttonAction'=>''.\Lang::get("messages.Edit").'','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"home_slider","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('home_slider.input',['buttonAction'=>''.\Lang::get("messages.save").'','required'=>'  *'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@stop
@section('script')
    <script>
        $('#home_slider').addClass('active');
        $('#home_slider_create').addClass('active');
    </script>
@stop
