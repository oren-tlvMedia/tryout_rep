<?php

//echo date("Y-m-d", strtotime(' -2 day'));
$startDay = date("Ymd", strtotime("first day of previous month"));
$endDay = date("Ymd", strtotime("last day of previous month"));

echo "\n";
echo "start date is $startDay  and end day is $endDay \n";
?>
