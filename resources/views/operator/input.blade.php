<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.operator name') <span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
        {!! Form::text('name',null,['placeholder'=>''.\Lang::get("messages.operator name").'','class'=>'form-control btn-lg','required']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Ussd Code') </label>
    <div class="col-sm-9 col-lg-10 controls">
        {!! Form::number('rbt_ussd_code',null,['placeholder'=>''.\Lang::get("messages.Ussd Code").'','class'=>'form-control','min'=>0]) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Sms Code') </label>
    <div class="col-sm-9 col-lg-10 controls">
        {!! Form::number('rbt_sms_code',null,['placeholder'=>''.\Lang::get("messages.Sms Code").'','class'=>'form-control','min'=>0]) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Country')<span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
        {!! Form::select('country_id',$countrys->pluck('title','id'),null,['class'=>'form-control chosen-rtl','required']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-md-2 control-label">@lang('messages.operator image') </label>
    <div class="col-sm-9 col-md-8 controls">
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                <img src="{{$operator->image ?? 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'}}" alt="" />
            </div>
            <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
            <div>
                <span class="btn btn-file"><span class="fileupload-new">@lang('messages.select_image')</span>
                    <span class="fileupload-exists">Change</span>
                    {!! Form::file('image',["accept"=>"image/*" ,"class"=>"default"]) !!}
                </span>
                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
            </div>
        </div>
        <span class="label label-important">NOTE!</span>
        <span>Only extensions supported png, jpg, and jpeg</span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
        {!! Form::submit($buttonAction,['class'=>'btn btn-primary']) !!}
    </div>
</div>
