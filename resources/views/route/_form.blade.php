<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Routes.method') Type *</label>
    <div class="col-sm-9 col-lg-10 controls">
        <select class="form-control chosen-rtl" name="method" required>
            @foreach($method_types as $index=>$type)
                <option value="{{$index}}" @if($route && $route->method==$index) selected @endif >{{$type}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Routes.Routes') *</label>
    <div class="col-sm-9 col-lg-10 controls">
        {!! Form::text('route',null, ['class'=>'form-control input-lg','required' => 'required']) !!}
    </div>
</div>

<?php
 if(!$route)
 {
    $controller_name = null ;
    $role_id = null ;
    if(isset($_GET['controller_name'])&&!empty($_GET['controller_name']))
    {
        $controller_name = $_GET['controller_name'] ;
    }
    if(isset($_GET['role'])&&!empty($_GET['role']))
    {
        $role_id = $_GET['role'] ;
    }
 }
 else{
     $controller_name = $route->controller_name ;
 }
?>

<div class="form-group">
  <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Routes.controller') *</label>
  <div class="col-sm-9 col-lg-10 controls">
   @if($controller_name)
    {!! Form::text('controller_name',$controller_name, ['class'=>'form-control input-lg','required' => 'required','readonly']) !!}
   @else
    {!! Form::text('controller_name',null, ['class'=>'form-control input-lg','required' => 'required']) !!}
   @endif
  </div>
</div>

<div class="form-group">
  <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Routes.method') *</label>
  <div class="col-sm-9 col-lg-10 controls">
   <select class="form-control chosen-rtl" name="function_name">
      <option value=""></option>
       @foreach($controllers as $index=>$controller)
           @for($i = 0 ; $i < count($controller) ; $i++)
                @if($index==$controller_name)
                  <?php
                        $controller[$i] = str_replace(' ','',$controller[$i]) ;
                   ?>
                   <option value="{{$controller[$i]}}" @if($route && $controller[$i] == $route->function_name) selected @endif>
                       {{$controller[$i]}}
                   </option>
                @endif
           @endfor
       @endforeach
   </select>
  </div>
</div>

<div class="form-group">
  <label class="col-sm-3 col-lg-2 control-label">@lang('messages.role') (optional)</label>
  <div class="col-sm-9 col-lg-10 controls">
      <select name="role[]" class="form-control chosen-rtl" multiple>
          @foreach($roles as $role)
              <option value="{{$role->id}}" @if($route) @foreach($route->roles_routes as $item) @if($item->role->id==$role->id)
               selected
              @endif
              @endforeach
                @elseif($role_id)
                  @if($role_id==$role->id)
                      selected
                  @endif
              @endif> {{$role->name}} </option>
          @endforeach
      </select>
  </div>
</div>
<div class="form-group">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
        {!! Form::button('<i class="fa fa-check"></i> Save',['type'=>'submit','class'=>'btn btn-primary']) !!}
    </div>
</div>
