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

<h1>Hi {{ $User->nickname }}: </h1>
<p>提醒您，您於 {{ $Transaction->created_at }}訂閱的 Spotify Premium 繳費已逾期。</p>
<p>應繳金額為 {{ $Transaction->total_price }}，請盡速繳款，謝謝。</p>

</body>
</html>
