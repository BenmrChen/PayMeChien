<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - PayMeChien</title>

</head>
<body>
<header>
    <ul class="nav">
        @if(session()->has('user_id'))
            <a href="/user/auth/sign-out">登出</a>
            <a href="/">首頁</a>
            <a href="/service">商品服務列表</a>
        @else
            <a href="/user/auth/sign-in">登入</a>
            <a href="/user/auth/sign-up">註冊</a>
            <a href="/">首頁</a>
            <a href="/service">商品服務列表</a>
        @endif
    </ul>
</header>

<div class="container">
    @yield('content')
</div>

<footer>
{{--    <a href="">聯絡我們</a>--}}
</footer>
</body>
</html>
