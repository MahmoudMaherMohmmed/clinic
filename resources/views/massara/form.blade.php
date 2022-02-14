@extends('template')
@section('page_title')
@lang('messages.massara.create_massara')
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.massara.create_massara') </h3>
                </div>
                <div class="box-content">
                    @if($massara)
                    {!! Form::model($massara,["url"=>"massara/$massara->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('massara.input',['buttonAction'=>''.\Lang::get("messages.Edit").'','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"massara","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('massara.input',['buttonAction'=>''.\Lang::get("messages.save").'','required'=>'  *'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@stop
@section('script')
    <script>
        $('#center').addClass('active');
        $('#massara_index').addClass('active');
    </script>
@stop
