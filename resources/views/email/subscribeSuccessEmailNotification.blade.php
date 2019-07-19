<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
    date_default_timezone_set("Asia/Taipei");
    $start_date = mktime(0,0,0,4,11,2019);
    $payment_deadline = strtotime("+2 Months", $start_date);
?>
<h1>恭喜 {{ $nickname }}，您已經成功訂閱 {{$buy_count}}份「{{ $service_name }}」</h1>

<h2>以下為您的訂閱資訊: </h2>
<p>繳費週期: {{$payment_period/30}}個月</p>
<p>繳費金額: {{$total_price}}</p>
<p>服務起始日期: 2019.04.11</p>
<p>繳費方式: {{$payment_method}}</p>

<h2>以下為您的繳費資訊: </h2>
<p>匯款帳號: 1234567890</p>
<p>最後匯款日期: {{ date("Y-m-d",$payment_deadline) }} (以服務起始日+2個月為基準)</p>

<h2>溫馨提醒: </h2>
<p>請在匯款後至本<a href="PayMeChien.test/transaction/payment">連結</a>點擊"已付款"並提供匯款後5碼以完成付款程序。</p>
(否則系統將計算遲滯金追討罰款喔 科科)<br>

</body>
</html>
