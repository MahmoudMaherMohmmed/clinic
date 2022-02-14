@extends('template')
@section('page_title')
@lang('messages.terms_conditions.terms_conditions_update')
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.terms_conditions.terms_conditions_update') </h3>
                </div>
                <div class="box-content">
                    @if($term)
                    {!! Form::model($term,["url"=>"term/$term->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('term.input',['buttonAction'=>''.\Lang::get("messages.Edit").'','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"term","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('term.input',['buttonAction'=>''.\Lang::get("messages.save").'','required'=>'  *'])
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
        $('#terms_index').addClass('active');
    </script>
@stop
