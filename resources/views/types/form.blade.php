

@if(Session::has('msg'))
        <div class="alert alert-info">
            <a class="close" data-dismiss="alert">×</a>
            <strong>Heads Up!</strong> {!!Session::get('msg')!!}
        </div>
@endif


<div class="form-group">
    {!! Form::label('title',\Lang::get('messages.Setting.Settings Types').'*',['class'=>'col-sm-3 col-lg-2 control-label']) !!}
    <div class="col-sm-9 col-lg-10 controls">
        {!! Form::text('title',null,['class'=>'form-control input-lg','required'=>'required','placeholder'=>\Lang::get('messages.Setting.Settings Types')]) !!}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
        {!! Form::submit($buttonAction,['class'=>'btn btn-primary']) !!}
    </div>
</div>


@section('script')
    <script>
        $('#type').addClass('active');
        $('#type-create').addClass('active');
    </script>
@stop

