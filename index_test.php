<?php 


$today = date("Y-m-d H:i:s"); // Ngày hôm nay
$proend = date("Y-m-d H:i:s", strtotime("+1 month", strtotime($today))); // Ngày hôm nay + 1 tháng

echo $proend;
?>