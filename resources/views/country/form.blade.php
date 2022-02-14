@extends('template')
@section('page_title')
  Country
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>Country Form</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    @if($country)
                    {!! Form::model($country,["url"=>"country/$country->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('country.input',['buttonAction'=>''.\Lang::get("messages.Edit").'','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"country","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('country.input',['buttonAction'=>''.\Lang::get("messages.save").'','required'=>'  *'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@stop
@section('script')
    <script>

    $('#country').addClass('active');
    $('#country_create').addClass('active');

    </script>
@stop
