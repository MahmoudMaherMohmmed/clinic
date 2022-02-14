<?php
$start = "00:00";
$end = "23:00";

$tStart = strtotime($start);
$tEnd = strtotime($end);
$tNow = $tStart;

while($tNow <= $tEnd){
  echo "<option value=" . date('H:i A',$tNow) . ">" . date('H:i A',$tNow) ."</option>";
  $tNow = strtotime('+60 minutes',$tNow);
}