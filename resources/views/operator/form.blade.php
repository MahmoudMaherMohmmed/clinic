@extends('template')
@section('page_title')
  Operator
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>Operator Form</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    @if($operator)
                    {!! Form::model($operator,["url"=>"operator/$operator->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('operator.input',['buttonAction'=>''.\Lang::get("messages.Edit").'','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"operator","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('operator.input',['buttonAction'=>''.\Lang::get("messages.save").''])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@stop
@section('script')
    <script>
        $('#operator').addClass('active');
        $('#operator_create').addClass('active');

    </script>
@stop
