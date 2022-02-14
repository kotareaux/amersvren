<!DOCTYPE html>
<html lang="ja">
<head>
<meta name="viewport" content="width=700px">
<link href="style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<title>@yield('title') | アメミュ練習室予約システム</title>
</head>
<body >
    <div class="oya">
        @include('layouts.header')
    <div class="boya">
        @yield('contents')
        @yield('table')
    </div>
</div>
</body>
</html>
