@extends('template')
@section('page_title')
@lang('messages.Setting.Setting')
@stop
@section('content')
<!-- BEGIN Content -->
<div id="main-content">
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.Setting.Setting')
                    </h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">

                    <form action="{{url('setting/'.$setting->id)}}" method="post" class="form-horizontal form-bordered form-row-stripped" enctype="multipart/form-data">
              			{!! csrf_field() !!}
                        <div class="form-group">
                            <label for="textfield5" class="col-sm-3 col-lg-2 control-label">Key</label>
                            <div class="col-sm-9 col-lg-10 controls">
                                <input type="text" name="key" id="key" value="{{$setting->key}}" placeholder="key" class="form-control" readonly required>
                            </div>
                        </div>

                        <input type="hidden" name="type_id" value="{{ $setting->type_id }}">

                        <div class="form-group">
                            @if($setting->type->title == "Image" || $setting->type->title == "Normal Editor" || $setting->type->title == "Advanced Editor" || $setting->type->title == "selector")
                                <label for="textfield5" class="col-sm-3 col-lg-2 control-label">Value</label>
                            @elseif($setting->type->title == "Video")
                                {!! Form::label('Video',\Lang::get('messages.video').'*',['class'=>'col-sm-3 col-lg-2 control-label']) !!}
                            @elseif($setting->type->title == "Audio")
                                {!! Form::label('Audio',\Lang::get('messages.audio').'*',['class'=>'col-sm-3 col-lg-2 control-label']) !!}
                            @elseif($setting->type->title == "File Manager Uploads Extensions")
                                {!! Form::label('File','Extensions Allowed *',['class'=>'col-sm-3 col-lg-2 control-label']) !!}
                            @endif
                            <div class="col-sm-9 col-lg-10 controls">
                                @if(file_exists($setting->value))
                                  @if($setting->type->title == "Image")
                                    <div class='col-sm-9 col-lg-10 controls'>
                                        <div class='fileupload fileupload-new' data-provides='fileupload'>
                                            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                                <img src="{{url($setting->value)}}" alt="" />
                                            </div>
                                            <div class='fileupload-preview fileupload-exists img-thumbnail' style='max-width: 200px; max-height: 150px; line-height: 20px;'></div>
                                            <div>
                                            <span class='btn btn-default btn-file'><span class='fileupload-new'>Select image</span>
                                            <span class='fileupload-exists'>Change</span>
                                            <input type='file' name='Image' accept="image/*"></span>
                                                <a href='#' class='btn btn-default fileupload-exists' data-dismiss='fileupload'>Remove</a>
                                            </div>
                                        </div>
                                        <span class='label label-important'>NOTE!</span>
                                        <span>Only extension supported jpg, png, and jpeg</span>
                                    </div>
                                   @elseif($setting->type->title == "Video")
                                    <div class="form-group"  id="videocont" novalidate>
                                    <div class="col-sm-9 col-lg-10 controls">
                                        {!! Form::file('Video',["accept"=>"video/*",'class'=>'default']) !!}
                                         <span class='label label-important'>NOTE!</span>
                                         <span>Only extension supported mp4, flv, and 3gp</span>
                                    </div>
                                    </div>

                                   @elseif($setting->type->title == "Audio")
                                    <div class="form-group" id="audiocont" novalidate>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            {!! Form::file('Audio',["accept"=>"audio/*",'class'=>'default']) !!}
                                         <span class='label label-important'>NOTE!</span>
                                         <span>Only extension supported mp3, webm, and wav</span>
                                        </div>
                                    </div>
                                    @endif
                                    <br>
                                @elseif($setting->type->title == "selector")
                                    <select class="form-control" name="value">
                                      <option value="1" @if($setting->value) selected @endif> True </option>
                                      <option value="0"  @if(!$setting->value) selected @endif> False</option>
                                    </select>
                                @else
                                    @if($setting->type->title == "File Manager Uploads Extensions")
                                        <?php
                                            $selected_extensions = explode(",",$setting->value)
                                        ?>
                                        <select class="form-control" name="value[]" multiple>
                                            <option value="image" @foreach($selected_extensions as $extension) @if($extension=='image') selected @endif @endforeach>Images</option>
                                            <option value="audio" @foreach($selected_extensions as $extension) @if($extension=='audio') selected @endif @endforeach>Audios</option>
                                            <option value="video" @foreach($selected_extensions as $extension) @if($extension=='video') selected @endif @endforeach>Videos</option>
                                            <option value="text" @foreach($selected_extensions as $extension) @if($extension=='text') selected @endif @endforeach>Text</option>
                                            <option value="all" @foreach($selected_extensions as $extension) @if($extension=='all') selected @endif @endforeach>All Extensions</option>
                                        </select>
                                    @elseif($setting->value[0]=="<")
                                        <textarea name="value" name="value" placeholder="value" class="form-control col-md-12 ckeditor" required>{{$setting->value}}</textarea>
                                    @else
                                        <textarea name="value" name="value" placeholder="value" class="form-control col-md-12" required>{{$setting->value}}</textarea>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="form-group last">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                               <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> update</button>
                            </div>
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
    <script>
        $('#setting').addClass('active');
        $('#setting-index').addClass('active');
    </script>
@stop
