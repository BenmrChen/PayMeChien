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
<h1>感謝 {{ $nickname }}，您已經成功完成「{{ $service_name }}」之付款流程</h1>

<h2>以下為您的付款資訊: </h2>
<p>繳費金額: {{$total_amount}}</p>
<p>服務起始日期: 2019.04.11</p>
<p>繳費方式: {{$payment_method}}</p>

<h2>以下為您的繳費資訊: </h2>
<p>匯款後5碼: {{ $payment_number }}</p>
<p>匯款日期: {{ $payment_date }}</p>


</body>
</html>
