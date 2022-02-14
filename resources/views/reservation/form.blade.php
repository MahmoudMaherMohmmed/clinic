@extends('template')
@section('page_title')
@lang('messages.reservations.create_reservation')
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.reservations.create_reservation') </h3>
                </div>
                <div class="box-content">
                    @if($reservation)
                    {!! Form::model($reservation,["url"=>"reservation/$reservation->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('reservation.input',['buttonAction'=>''.\Lang::get("messages.Edit").'','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"reservation","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('reservation.input',['buttonAction'=>''.\Lang::get("messages.save").'','required'=>'  *'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@stop
@section('script')
    <script>
        $('#reservation').addClass('active');
        $('#reservation_index').addClass('active');
    </script>
@stop
