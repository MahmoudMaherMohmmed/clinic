@extends('template')
@section('page_title')
@lang('messages.doctors.create_doctor')
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.doctors.create_doctor') </h3>
                </div>
                <div class="box-content">
                    @if($doctor)
                    {!! Form::model($doctor,["url"=>"doctor/$doctor->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('doctor.input',['buttonAction'=>''.\Lang::get("messages.Edit").'','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"doctor","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('doctor.input',['buttonAction'=>''.\Lang::get("messages.save").'','required'=>'  *'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@stop
@section('script')
    <script>
        $('#doctor').addClass('active');
        $('#doctor_create').addClass('active');
    </script>
@stop
