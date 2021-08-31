<header>
    <span class="nama"><a href="{{ url('/view') }}" class="titl">アメミュ練習室予約システム</a></span>
    <span class="slbtn">
    @auth
    <a href="{{ route('logout') }}"><button class='yhhb'>ログアウト</button></a>
    @else
    <a href="{{ route('login') }}"><button class='yhhb'>管理ページ</button></a>
    @endauth
    </span>
</header>
