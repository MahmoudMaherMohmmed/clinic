<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Parent Category')</label>
    <div class="col-sm-9 col-lg-10 controls">
        @if (isset(request()->category_id))
            {!! Form::select('parent_id',$parents->pluck('title','id')->toArray(),null,['class'=>'form-control chosen-rtl']) !!}
        @else
            {!! Form::select('parent_id',[''=>'']+$parents->pluck('title','id')->toArray(),null,['class'=>'form-control chosen-rtl']) !!}
        @endif
    </div>
</div>



<div class="form-group"  id="cktextarea">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Title') <span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls" >
        <ul id="myTab1" class="nav nav-tabs">
                <?php $i=0;?>
                @foreach($languages as $language)
                    <li class="{{($i++)? '':'active'}}"><a href="#title{{$language->short_code}}" data-toggle="tab"> {{$language->title}}</a></li>
                @endforeach
        </ul>
        <div class="tab-content">
            <?php $i=0;?>
            @foreach($languages as $language)
                <div class="tab-pane fade in {{($i++)? '':'active'}}" id="title{{$language->short_code}}">
                    <input class="form-control" name="title[{{$language->short_code}}]" value="@if($category){!! $category->getTranslation('title',$language->short_code)  !!} @else {{ old('title.' . $language->short_code) }}@endif"/>
                </div>
            @endforeach
        </div>
    </div>
</div>


<br>
<br>
<br>
<br>

<div class="form-group">
    <label class="col-sm-3 col-md-2 control-label">@lang('messages.Image.Image') </label>
    <div class="col-sm-9 col-md-8 controls">
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                @if($category)
                    <img src="{{$category->image}}" alt="" />
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
