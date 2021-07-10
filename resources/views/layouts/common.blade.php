<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" name="viewport" content="target-densitydpi=device-dpi,width=600px,maximum-scale=1.0,user-scalable=yes" />
<link  href="style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">

<title>@yield('title') | アメミュ練習室予約システム</title>
</head>
<body >
    <div class="oya">
    <header>
        @include('layouts.header')
    </header>
    <main class="boya">
        @yield('content')
    </main>
</div>
</body>
</html>
