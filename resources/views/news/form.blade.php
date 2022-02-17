@extends('template')
@section('page_title')
@lang('messages.news.create_news')
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.news.create_news') </h3>
                </div>
                <div class="box-content">
                    @if($new)
                    {!! Form::model($new,["url"=>"news/$new->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('news.input',['buttonAction'=>''.\Lang::get("messages.Edit").'','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"news","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('news.input',['buttonAction'=>''.\Lang::get("messages.save").'','required'=>'  *'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@stop
@section('script')
    <script>
        $('#news').addClass('active');
        $('#news_create').addClass('active');
    </script>
@stop
