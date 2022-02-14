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


                    <form action="{{url('setting')}}" method="post" class="form-horizontal form-bordered form-row-stripped" enctype="multipart/form-data" >
              			{!! csrf_field() !!}
                          <input id="hidden_key" name="key" type="hidden" />

                        <div class="form-group">
                            <label for="textfield5" class="col-sm-3 col-lg-2 control-label">@lang('messages.Setting.Setting')
                                type</label>
                            <div class="col-sm-9 col-lg-10 controls">
                                <select id="first_select" name="type_id" class="form-control chosen-rtl">
                                   @foreach ($types as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="textfield5" class="col-sm-3 col-lg-2 control-label">@lang('messages.Key') *</label>
                            <div class="col-sm-9 col-lg-10 controls">
                                <input type="text" name="key" value="{{ old('key') ?? '' }}" id="key" placeholder="key" class="form-control" required>
                            </div>
                          </div>


                        <div class="form-group"  id="cktextarea">
                            <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Value') *</label>
                            <div class="col-sm-9 col-lg-10 controls" >
                                <textarea class="form-control col-md-12 ckeditor" name="advanced_text" rows="6"></textarea>
                            </div>
                        </div>

                        <div class="form-group" hidden id="normal_textarea">
                            <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Value') *</label>
                            <div class="col-sm-9 col-lg-10 controls" >
                                <textarea class="form-control col-md-12" name="normal_text" rows="6"></textarea>
                            </div>
                        </div>


                        <div class="form-group" hidden id="image_div">
                            <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Image.Image') *</label>
                            <div class='col-sm-9 col-lg-10 controls'>
                                <div class='fileupload fileupload-new' data-provides='fileupload'>
                                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                    </div>
                                    <div class='fileupload-preview fileupload-exists img-thumbnail' style='max-width: 200px; max-height: 150px; line-height: 20px;'></div>
                                    <div>
                                                <span class='btn btn-default btn-file'><span class='fileupload-new'>Select @lang('messages.Image.Image')</span>
                                                <span class='fileupload-exists'></span>
                                                <input type='file' name='image' accept="image/*"></span>
                                        <a href='#' class='btn btn-default fileupload-exists' data-dismiss='fileupload'>@lang('messages.campain.remove-file')</a>
                                    </div>
                                </div>
                                <span class='label label-important'>NOTE!</span>
                                <span>Only extension supported jpg, png, and jpeg</span>
                            </div>
                        </div>

                        <div class="form-group" hidden id="videocont" novalidate>
                          {!! Form::label('Video',\Lang::get('messages.video').'*',['class'=>'col-sm-3 col-lg-2 control-label']) !!}
                          <div class="col-sm-9 col-lg-10 controls">
                              {!! Form::file('video',["accept"=>"video/*",'class'=>'default']) !!}
                               <span class='label label-important'>NOTE!</span>
                               <span>Only extension supported mp4, flv, and 3gp</span>
                          </div>

                        </div>

                        <div class="form-group" hidden id="audiocont" novalidate>
                            {!! Form::label('Audio',\Lang::get('messages.audio').'*',['class'=>'col-sm-3 col-lg-2 control-label']) !!}
                            <div class="col-sm-9 col-lg-10 controls">
                                {!! Form::file('audio',["accept"=>"audio/*",'class'=>'default']) !!}
                             <span class='label label-important'>NOTE!</span>
                             <span>Only extension supported mp3, webm, and wav</span>
                            </div>
                        </div>

                        <div class="form-group" hidden id="fileManCont" novalidate>
                            {!! Form::label('File','Extensions Allowed *',['class'=>'col-sm-3 col-lg-2 control-label']) !!}
                            <div class="col-sm-9 col-lg-10 controls">
                                <select class="form-control" name="extensions[]" multiple>
                                    <option value="image">Images</option>
                                    <option value="video">Videos</option>
                                    <option value="audio">Audios</option>
                                    <option value="text">Text</option>
                                    <option value="all">All Extensions</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" hidden id="selector">
                            <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Value') *</label>
                            <div class="col-sm-9 col-lg-10 controls" >
                                <select class="form-control" name="selector">
                                  <option value="1"> True </option>
                                  <option value="0"> False</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group last">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                               <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>@lang('messages.save') </button>
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
        $('#first_select').on('change', function() {
            $('#key').prop('disabled', false);
            $('#hidden_key').val('') ;
            if (this.value == 1) {
                $('#normal_textarea').hide('slow');
                $('#image_div').hide('slow') ;
                $('#videocont').hide('slow');
                $('#audiocont').hide('slow') ;
                $('#cktextarea').show(1000);
                $('#fileManCont').hide('slow') ;
                $('#selector').hide('slow') ;
            }
            else if (this.value == 2)
            {
                $('#normal_textarea').show(1000) ;
                $('#image_div').hide('slow');
                $('#cktextarea').hide('slow');
                $('#videocont').hide('slow');
                $('#audiocont').hide('slow') ;
                $('#fileManCont').hide('slow') ;
                $('#selector').hide('slow') ;
            }
            else if(this.value == 3)
            {
                $('#normal_textarea').hide('slow');
                $('#image_div').show(1000) ;
                $('#cktextarea').hide('slow');
                $('#videocont').hide('slow');
                $('#audiocont').hide('slow') ;
                $('#fileManCont').hide('slow') ;
                $('#selector').hide('slow') ;
            }
            else if(this.value == 4)
            {
                $('#normal_textarea').hide('slow');
                $('#videocont').show(1000) ;
                $('#cktextarea').hide('slow');
                $('#image_div').hide('slow');
                $('#audiocont').hide('slow') ;
                $('#fileManCont').hide('slow') ;
                $('#selector').hide('slow') ;
            }
            else if (this.value == 5)
            {
                $('#normal_textarea').hide('slow');
                $('#audiocont').show(1000) ;
                $('#cktextarea').hide('slow');
                $('#image_div').hide('slow');
                $('#videocont').hide('slow') ;
                $('#fileManCont').hide('slow') ;
                $('#selector').hide('slow') ;
            }
            else if (this.value == 6)
            {
                $('#normal_textarea').hide('slow');
                $('#audiocont').hide('slow') ;
                $('#cktextarea').hide('slow');
                $('#image_div').hide('slow');
                $('#videocont').hide('slow') ;
                $('#fileManCont').show(1000) ;
                $('#key').prop('disabled', true);
                $('#key').prop('value',"uploadAllow");
                $('#hidden_key').val('uploadAllow') ;
                $('#selector').hide('slow') ;
            }
            else if (this.value == 7)
            {
                $('#normal_textarea').hide('slow');
                $('#audiocont').hide('slow');
                $('#cktextarea').hide('slow');
                $('#image_div').hide('slow');
                $('#videocont').hide('slow') ;
                $('#fileManCont').hide('slow') ;
                $('#selector').show(1000) ;
            }

        });

        $('#setting').addClass('active');
        $('#setting-create').addClass('active');
    </script>
@stop
