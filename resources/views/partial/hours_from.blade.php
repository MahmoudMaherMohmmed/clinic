<?php
$start = "00:00";
$end = "23:00";

$tStart = strtotime($start);
$tEnd = strtotime($end);
$tNow = $tStart;
?>

@while($tNow <= $tEnd)
  <option value="{{date('H:i A',$tNow)}}" {{$center && $center->from==date('H:i A',$tNow) ? 'selected' : '' }}>{{date('H:i A',$tNow)}}</option>;
  @php $tNow = strtotime('+60 minutes',$tNow); @endphp
@endwhile