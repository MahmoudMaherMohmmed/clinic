@extends('template')
@section('page_title')
@lang('messages.banks.create_bank')
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.banks.create_bank') </h3>
                </div>
                <div class="box-content">
                    @if($bank)
                    {!! Form::model($bank,["url"=>"bank/$bank->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('bank.input',['buttonAction'=>''.\Lang::get("messages.Edit").'','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"bank","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('bank.input',['buttonAction'=>''.\Lang::get("messages.save").'','required'=>'  *'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@stop
@section('script')
    <script>
        $('#bank').addClass('active');
        $('#bank_create').addClass('active');
    </script>
@stop
