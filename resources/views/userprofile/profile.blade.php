@extends('template')
@section('page_title')
    @lang('messages.profile')
@stop

@section('content')
    <div class="box">
        <div class="box-title">
            <h3><i class="fa fa-file"></i>@lang('messages.profile_info')</h3>
            <div class="box-tool">
                <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                <a data-action="close" href="#"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="box-content">
            <div class="row">
                <div class="col-md-3">
                    <img class="img-responsive img-thumbnail" src="{{$user->image}}" alt="profile picture" />
                    <br/><br/>
                </div>
                <div class="col-md-9 user-profile-info">
                    <p><span>@lang('messages.users.user_name'):</span> {{$user->name}}</p>
                    <p><span>@lang('messages.users.email'):</span> <a href="#">{{$user->email}}</a></p>
                    {{--<p><span>User Role:</span>{{$role}}</p>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-blue">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i>@lang('messages.edit') @lang('messages.profile_info')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form action="{{url('user_profile/updateuserdata')}}" class="form-horizontal" method="post">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.user_name') *</label>
                            <div class="col-sm-9 col-lg-10 controls">
                                <input type="text" value="{{$user->name}}" class="form-control" name="name" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.email') *</label>
                            <div class="col-sm-9 col-lg-10 controls">
                                <input type="text" value="{{$user->email}}" class="form-control" name="email" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.phone') *</label>
                            <div class="col-sm-9 col-lg-10 controls">
                                <input type="text" name="phone" placeholder="@lang('messages.users.phone')" value="{{$user->phone}}" class="form-control input-lg" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-blue">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i>@lang('messages.edit_profile_picture')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                        {!! Form::open(['url'=>'user_profile/updateprofilepic' , 'method'=>'post' , 'class'=>'form-horizontal', 'files'=>'true' ]) !!}
                        <div class="form-group">
                            <label class="col-sm-3 col-md-4 control-label">@lang('messages.image')</label>
                            <div class="col-sm-9 col-md-8 controls">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                        <img src="{{$user->image}}" alt="" />
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
                            <div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-blue">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i>@lang('messages.edit') @lang('messages.users.password')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form id="form-change-password" role="form" method="POST" action="{{ url('/user_profile/updatepassword') }}" novalidate class="form-horizontal">
                        <div class="col-md-9">
                            <label for="current-password" class="col-sm-4 control-label">@lang('messages.old_password')</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Password" required>
                                </div>
                            </div>
                            <label for="password" class="col-sm-4 control-label">@lang('messages.new_password')</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                </div>
                            </div>
                            <label for="password_confirmation" class="col-sm-4 control-label">@lang('messages.reenter') @lang('messages.new_password')</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-6">
                                <button type="submit" class="btn btn-danger">@lang('messages.save')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
