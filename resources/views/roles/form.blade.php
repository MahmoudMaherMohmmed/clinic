<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.roles.role-name') *</label>
    <div class="col-sm-9 col-lg-10 controls">
        <input type="text" name="name" placeholder="@lang('messages.roles.role-name')" class="form-control input-lg" value="{{ $role->name ?? old('name') }}" required>
    </div>
</div>

<div class="form-group" id="priority-type">
    <label class="col-sm-3 col-lg-2 control-label">Priority *</label>
    <div class="col-sm-9 col-md-10 controls">
        <select class="form-control" id="role_priority" name="role_priority" required>
            <option value>Select Priority</option>
            <option value="1" {{ isset($role) && $role->role_priority == 1 ? 'selected' : '' }}>1</option>
            <option value="2" {{ isset($role) && $role->role_priority == 2 ? 'selected' : '' }}>2</option>
            <option value="3" {{ isset($role) && $role->role_priority == 3 ? 'selected' : '' }}>3</option>
        </select>
        <span class="help-inline">1 is the lowest</span>
    <br/>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
        <input type="submit" class="btn btn-primary" value="@lang('messages.save')">
    </div>
</div>
