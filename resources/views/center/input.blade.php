<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.description') <span
            class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
        <ul id="myTab1" class="nav nav-tabs">
            <?php $i = 0; ?>
            @foreach ($languages as $language)
                <li class="{{ $i++ ? '' : 'active' }}"><a href="#description{{ $language->short_code }}"
                        data-toggle="tab"> {{ $language->title }}</a></li>
            @endforeach
        </ul>
        <div class="tab-content">
            <?php $i = 0; ?>
            @foreach ($languages as $language)
                <div class="tab-pane fade in {{ $i++ ? '' : 'active' }}"
                    id="description{{ $language->short_code }}">
                    <textarea class="form-control col-md-12"
                        name="description[{{ $language->short_code }}]" 
                        rows="6">{{ $center!=null ? $center->getTranslation('description', $language->short_code) : old('description.' . $language->short_code)}}
                    </textarea>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.centers.working_days')<span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
      <select class="form-control chosen-rtl" name="working_days[]" required multiple>
          @include('partial.days')
      </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.centers.working_hours')<span class="text-danger">*</span></label>
    <div class="col-sm-4 col-lg-5 controls">
      <select class="form-control chosen-rtl" name="from" required>
          @include('partial.hours_from')
      </select>
    </div>
    <div class="col-sm-5 col-lg-5 controls">
      <select class="form-control chosen-rtl" name="to" required>
            @include('partial.hours_to')
      </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.centers.emails') <span class="text-danger">*</span></label>
    <div class="col-sm-4 col-lg-5 controls">
        <input type="email" class="form-control" name="email" placeholder="@lang('messages.centers.email')" value="@if ($center) {!! $center->email !!} @endif" />
    </div>
    <div class="col-sm-5 col-lg-5 controls">
        <input type="email" class="form-control" name="contact_email" placeholder="@lang('messages.centers.contact_email')" value="@if ($center) {!! $center->contact_email !!} @endif" />
    </div>
</div> 

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.centers.phones') <span class="text-danger">*</span></label>
    <div class="col-sm-4 col-lg-5 controls">
        <input type="text" class="form-control" name="phone_1" placeholder="@lang('messages.centers.phone_1')" value="@if ($center) {!! $center->phone_1 !!} @endif" />
    </div>
    <div class="col-sm-5 col-lg-5 controls">
        <input type="text" class="form-control" name="phone_2" placeholder="@lang('messages.centers.phone_2')" value="@if ($center) {!! $center->phone_2 !!} @endif" />
    </div>
</div> 

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.centers.social_links') <span class="text-danger">*</span></label>
    <div class="col-sm-3 col-lg-3 controls">
        <input type="url" class="form-control" name="facebook_link" placeholder="@lang('messages.centers.facebook_link')" value="@if ($center) {!! $center->facebook_link !!} @endif" />
    </div>
    <div class="col-sm-3 col-lg-3 controls">
        <input type="text" class="form-control" name="whatsapp_link" placeholder="@lang('messages.centers.whatsapp_link')" value="@if ($center) {!! $center->whatsapp_link !!} @endif" />
    </div>
    <div class="col-sm-3 col-lg-4 controls">
        <input type="url" class="form-control" name="instagram_link" placeholder="@lang('messages.centers.instagram_link')" value="@if ($center) {!! $center->instagram_link !!} @endif" />
    </div>
</div> 

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.centers.location') <span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10">
        <div class="row">
            <div class="col-sm-6 col-lg-6 controls">
                <input type="text" class="form-control" name="lat" value="@if ($center) {!! $center->lat !!} @endif"/>
            </div>
            <div class="col-sm-6 col-lg-6 controls">
                <input type="text" class="form-control" name="lng" value="@if ($center) {!! $center->lng !!} @endif"/>
            </div>
        </div>

        <div id="map" style="margin-top: 10px; height: 400px; width: 100%;"> </div>
    </div>
</div> 

<div class="form-group">
    <label class="col-sm-3 col-md-2 control-label">@lang('messages.Image.Image')</label>
    <div class="col-sm-9 col-md-8 controls">
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                @if($center)
                    <img src="{{url($center->logo)}}" alt="" />
                @else
                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                @endif
            </div>
            <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
            <div>
                <span class="btn btn-file"><span class="fileupload-new">@lang('messages.select_image')</span>
                    <span class="fileupload-exists">Change</span>
                    {!! Form::file('logo',["accept"=>"image/*" ,"class"=>"default"]) !!}
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
