<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Key')*</label>
    <div class="col-sm-9 col-lg-10 controls">
        {!! Form::text('key_word',old('key_word'), ['class'=>'form-control input-lg','required' => 'required']) !!}
    </div>
</div>

<div class="form-group text_field1">
  <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Value') *</label>
  <div class="col-sm-9 col-lg-10 controls tabbable">
      <ul id="myTab1" class="nav nav-tabs">
        <?php $i=0;?>
        @foreach($languages as $language)
          <li class="{{($i++)? '':'active'}}"><a href="#translations{{$language->short_code}}" data-toggle="tab"> {{$language->title}}</a></li>
        @endforeach
      </ul>

      <div class="tab-content">
        <?php $i=0;?>
        @foreach($languages as $language)
          <div class="tab-pane fade in {{($i++)? '':'active'}}" id="translations{{$language->short_code}}">
             {!! Form::textarea("translations[$language->id]",(isset($static_translation)) ? $static_translation->getBody($language->short_code):null, ['class'=>'form-control input-lg ckeditor','placeholder'=>"$language->title"]) !!}
          </div>
        @endforeach
      </div>
  </div>
</div>

<div class="form-group">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
        {!! Form::button('<i class="fa fa-check"></i> '.\Lang::get("messages.save").'',['type'=>'submit','class'=>'btn btn-primary']) !!}
    </div>
</div>
