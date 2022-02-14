@extends('template')
@section('page_title')
@lang('messages.specialties.create_specialty')
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.specialties.create_specialty') </h3>
                </div>
                <div class="box-content">
                    @if($specialty)
                    {!! Form::model($specialty,["url"=>"specialty/$specialty->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('specialty.input',['buttonAction'=>''.\Lang::get("messages.Edit").'','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"specialty","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('specialty.input',['buttonAction'=>''.\Lang::get("messages.save").'','required'=>'  *'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@stop
@section('script')
    <script>
        $('#specialty').addClass('active');
        $('#specialty_create').addClass('active');
    </script>
@stop
