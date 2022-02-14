@extends('template')
@section('page_title')
@lang('messages.clients.create_client')
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.clients.create_client') </h3>
                </div>
                <div class="box-content">
                    @if($client)
                    {!! Form::model($client,["url"=>"client/$client->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('client.input',['buttonAction'=>''.\Lang::get("messages.Edit").'','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"client","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('client.input',['buttonAction'=>''.\Lang::get("messages.save").'','required'=>'  *'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@stop
@section('script')
    <script>
        $('#client').addClass('active');
        $('#client_create').addClass('active');
    </script>
@stop
