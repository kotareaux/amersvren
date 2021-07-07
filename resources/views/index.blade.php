<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>select</title>
</head>
<body >
        @foreach ($db1 as $syain)
            <p>
            {{ $syain->date }}
            {{ $syain->time }}
            {{ $syain->band }}
            {{ $syain->name }}
            {{ $syain->biko }}
            </p>
        @endforeach
</body>
</html>