<!DOCTYPE html>
<html lang="ja">
<head>
<meta name="viewport" content="width=device-width,initial-scale=2.5">
<link  href="style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">

<title>@yield('title') | アメミュ練習室予約システム</title>
</head>
<body >
    <div class="oya">
        @include('layouts.header')
    <div class="boya">
        @yield('content')
        @yield('table')
    </div>
</div>
</body>
</html>
