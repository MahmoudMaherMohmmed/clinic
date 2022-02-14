{{ csrf_field() }}
<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.user_name') *</label>
    <div class="col-sm-9 col-lg-10 controls">
        <input type="text" name="name" placeholder="@lang('messages.users.user_name')" class="form-control input-lg"
            required value="{{ $user->name ?? old('name') }}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.email') *</label>
    <div class="col-sm-9 col-lg-10 controls">
        <input type="email" name="email" placeholder="@lang('messages.users.email')" class="form-control input-lg"
            required value="{{ $user->email ?? old('email') }}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.password') *</label>
    <div class="col-sm-9 col-lg-10 controls">
        <input type="password" name="password" placeholder="@lang('messages.users.password')"
            class="form-control input-lg" {{ isset($user) ? '' : 'required' }}>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.phone') (optional)</label>
    <div class="col-sm-9 col-lg-10 controls">
        <input type="text" name="phone" placeholder="@lang('messages.users.phone')" class="form-control input-lg"
            value="{{ $user->phone ?? old('phone') }}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.role') *</label>
    <div class="col-sm-9 col-lg-10 controls">
        <select class="form-control chosen-rtl" data-placeholder="Choose a Role" name="role" tabindex="1" required>
            @foreach($roles as $role)
            <option value="{{$role->id}}"
                {{ isset($user) && $user->role_id == $role->id ? 'selected' : (old('role') == $role->id ? 'selected' : '') }}>
                {{$role->name}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
        <input type="submit" class="btn btn-primary" value="@lang('messages.save')">
    </div>
</div>
