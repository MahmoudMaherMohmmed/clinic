<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.name') <span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
        <ul id="myTab1" class="nav nav-tabs">
            <?php $i = 0; ?>
            @foreach ($languages as $language)
                <li class="{{ $i++ ? '' : 'active' }}"><a href="#name{{ $language->short_code }}"
                        data-toggle="tab">
                        {{ $language->title }}</a></li>
            @endforeach
        </ul>
        <div class="tab-content">
            <?php $i = 0; ?>
            @foreach ($languages as $language)
                <div class="tab-pane fade in {{ $i++ ? '' : 'active' }}" id="name{{ $language->short_code }}">
                    <input class="form-control" name="name[{{ $language->short_code }}]" value="@if ($bank) {!! $bank->getTranslation('name', $language->short_code) !!} @endif" />
                </div>
            @endforeach
        </div>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">IBAN <span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
        <input type="text" class="form-control" name="IBAN" value="@if ($bank) {!! $bank->IBAN !!} @endif" />
    </div>
</div> 

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.banks.account_name') <span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
        <input type="text" class="form-control" name="account_name" value="@if ($bank) {!! $bank->account_name !!} @endif" />
    </div>
</div> 

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.banks.account_number') <span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
        <input type="text" class="form-control" name="account_number" value="@if ($bank) {!! $bank->account_number !!} @endif" />
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-md-2 control-label">@lang('messages.Image.Image')</label>
    <div class="col-sm-9 col-md-8 controls">
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                @if($bank)
                    <img src="{{isset($bank->image)&& $bank->image!=null ? url($bank->image) : ''}}" alt="" />
                @else
                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                @endif
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
