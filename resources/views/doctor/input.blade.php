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
                    <input class="form-control" name="name[{{ $language->short_code }}]" value="@if ($doctor) {!! $doctor->getTranslation('name', $language->short_code) !!} @endif" />
                </div>
            @endforeach
        </div>
    </div>
</div>
 
<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.doctors.specialty')<span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
      <select class="form-control chosen-rtl" name="specialty_id" required>
        @foreach($specialties as $specialty)
        <option value="{{$specialty->id}}" {{$doctor && $doctor->specialty_id==$specialty->id ? 'selected' : '' }}>{{$specialty->title}}</option>
        @endforeach
      </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.doctors.subspecialty') <span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
        <ul id="myTab1" class="nav nav-tabs">
            <?php $i = 0; ?>
            @foreach ($languages as $language)
                <li class="{{ $i++ ? '' : 'active' }}"><a href="#subspecialty{{ $language->short_code }}"
                        data-toggle="tab">
                        {{ $language->title }}</a></li>
            @endforeach
        </ul>
        <div class="tab-content">
            <?php $i = 0; ?>
            @foreach ($languages as $language)
                <div class="tab-pane fade in {{ $i++ ? '' : 'active' }}" id="subspecialty{{ $language->short_code }}">
                    <input class="form-control" name="subspecialty[{{ $language->short_code }}]" value="@if ($doctor) {!! $doctor->getTranslation('subspecialty', $language->short_code) !!} @endif" />
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.doctors.medical_examination_price') <span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
        <input type="text" class="form-control" name="medical_examination_price" value="@if ($doctor) {!! $doctor->medical_examination_price !!} @endif" />
    </div>
</div> 

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.doctors.graduation_university') <span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
        <ul id="myTab1" class="nav nav-tabs">
            <?php $i = 0; ?>
            @foreach ($languages as $language)
                <li class="{{ $i++ ? '' : 'active' }}"><a href="#graduation_university{{ $language->short_code }}"
                        data-toggle="tab">
                        {{ $language->title }}</a></li>
            @endforeach
        </ul>
        <div class="tab-content">
            <?php $i = 0; ?>
            @foreach ($languages as $language)
                <div class="tab-pane fade in {{ $i++ ? '' : 'active' }}" id="graduation_university{{ $language->short_code }}">
                    <input class="form-control" name="graduation_university[{{ $language->short_code }}]" value="@if ($doctor) {!! $doctor->getTranslation('graduation_university', $language->short_code) !!} @endif" />
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-md-2 control-label">@lang('messages.Image.Image')</label>
    <div class="col-sm-9 col-md-8 controls">
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                @if($doctor)
                    <img src="{{url($doctor->image)}}" alt="" />
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
