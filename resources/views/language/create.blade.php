@extends('template')

@section('page_title')
@lang('messages.Static Translations.Add Language')
@stop

@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.Static Translations.Add Language')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                     @if(isset($language))
                        {!! Form::model($language, ['url'=>'language/'.$language->id.'/update' , 'method' => 'post', 'class' => 'form-horizontal', 'files'=>'true' ]) !!}

                    @else
                        {!! Form::open(['method' => 'POST', 'url'=>'language' , 'class' => 'form-horizontal', 'files'=>'true' ]) !!}


                    @endif
                        @include('language._form')
                        {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>

@stop

@section('script')
    <script>
        $('#language').addClass('active');
        $('#language-create').addClass('active');
    </script>
@stop
