{{ csrf_field() }}
<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.name') *</label>
    <div class="col-sm-9 col-lg-10 controls">
        <input type="text" name="name" placeholder="@lang('messages.name')" class="form-control input-lg"
            required value="{{ $client->name ?? old('name') }}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.email') *</label>
    <div class="col-sm-9 col-lg-10 controls">
        <input type="email" name="email" placeholder="@lang('messages.users.email')" class="form-control input-lg"
            required value="{{ $client->email ?? old('email') }}">
    </div>
</div>

@if(!isset($client) || $client==null)
    <div class="form-group">
        <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.password') *</label>
        <div class="col-sm-9 col-lg-10 controls">
            <input type="password" name="password" placeholder="@lang('messages.users.password')"
                class="form-control input-lg" {{ isset($user) ? '' : 'required' }}>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.confirm_password') *</label>
        <div class="col-sm-9 col-lg-10 controls">
            <input type="password" name="password_confirmation" placeholder="@lang('messages.users.confirm_password')"
                class="form-control input-lg" {{ isset($user) ? '' : 'required' }}>
        </div>
    </div>
@endif
<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.phone') *</label>
    <div class="col-sm-9 col-lg-10 controls">
        <input type="text" name="phone" placeholder="@lang('messages.users.phone')" class="form-control input-lg"
            value="{{ $client->phone ?? old('phone') }}">
    </div>
</div>
<div class="form-group">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
        <input type="submit" class="btn btn-primary" value="@lang('messages.save')">
    </div>
</div>
