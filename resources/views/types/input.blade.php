@extends('template')
@section('page_title')

@lang('messages.Setting.Settings Types')

@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-blue">
                <div class="box-title">
                    @if($type != null)
                        <h3><i class="fa fa-table"></i> Update @lang('messages.Setting.Settings Types')</h3>
                    @else
                        <h3><i class="fa fa-table"></i> @lang('messages.Setting.Add Type')</h3>
                    @endif
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    @if($type != null)
                        {!! Form::model($type,['url'=>'types/'.$type->id,'class'=>'form-horizontal','files'=>'true','method'=>'PATCH']) !!}
                        @include('types.form',['buttonAction'=>\Lang::get('messages.edit'),'required'=>'  *'])
                    @else
                        {!! Form::open(['url'=>'types','class'=>'form-horizontal','files'=>'true','method'=>'POST']) !!}
                        @include('types.form',['buttonAction'=>\Lang::get('messages.save'),'required'=>' *'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop
