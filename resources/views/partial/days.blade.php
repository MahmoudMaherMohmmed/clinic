@php $days = ['sat', 'sun', 'mon', 'tue', 'wed', 'thu', 'fri']; @endphp

@foreach($days as $day)
  <option value="{{ $day }}" {{$center && str_contains($center->working_days, $day) ? 'selected' : '' }}>{{ trans("messages.week.$day")}}</option>;
@endforeach