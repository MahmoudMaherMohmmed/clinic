<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.doctors.doctors') </label>
    <div class="col-sm-9 col-lg-10 controls">
      <select class="form-control chosen-rtl" name="dictor_id" required disabled>
        @foreach($doctors as $doctor)
        <option value="{{$doctor->id}}">{{$doctor->name}}</option>
        @endforeach
      </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.appointments.date') </label>
    <div class="col-sm-4 col-lg-5 controls">
        <input type="text" class="form-control" name="date" value="@if ($reservation) {!! $reservation->date !!} @endif" disabled/>
    </div>
    <div class="col-sm-5 col-lg-5 controls">
        <input type="text" class="form-control" name="time" value="@if ($reservation) {!! $reservation->from !!} @endif" disabled/>
    </div>
</div> 

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.reservations.patient_name') </label>
    <div class="col-sm-9 col-lg-10 controls">
        <input type="text" class="form-control" name="patient_name" value="@if ($reservation) {!! $reservation->patient_name !!} @endif" />
    </div>
</div> 

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.reservations.phone_number') </label>
    <div class="col-sm-9 col-lg-10 controls">
        <input type="text" class="form-control" name="phone_number" value="@if ($reservation) {!! $reservation->phone_number !!} @endif" />
    </div>
</div> 

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.reservations.age') </label>
    <div class="col-sm-9 col-lg-10 controls">
        <input type="text" class="form-control" name="age" value="@if ($reservation) {!! $reservation->age !!} @endif" />
    </div>
</div> 

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.reservations.gender') </label>
    <div class="col-sm-9 col-lg-10 controls">
        <select class="form-control chosen-rtl" name="gender" required>
            <option value="0" {{$reservation && $reservation->gender==0 ? 'selected' : '' }}>Male</option>
            <option value="1" {{$reservation && $reservation->gender==1 ? 'selected' : '' }}>Female</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.description') <span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
        <textarea class="form-control" name="description" rows=6>{{$reservation ? $reservation->description : ''}}</textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">@lang('messages.status.status')<span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
      <select class="form-control chosen-rtl" name="status" required>
        <option value="1" {{$reservation && $reservation->status==1 ? 'selected' : '' }}>@lang('messages.status.under_review')</option>
        <option value="2" {{$reservation && $reservation->status==2 ? 'selected' : '' }}>@lang('messages.status.approved')</option>
        <option value="0" {{$reservation && $reservation->status==0 ? 'selected' : '' }}>@lang('messages.status.rejected')</option>
      </select>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
        {!! Form::submit($buttonAction,['class'=>'btn btn-primary']) !!}
    </div>
</div>
