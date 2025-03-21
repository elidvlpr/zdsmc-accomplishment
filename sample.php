<?php
$input = "3-3-2025"; // Example input (DD-MM-YYYY)
list($day, $month, $year) = explode('-', $input);

$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

echo "$days_in_month Days";
?>