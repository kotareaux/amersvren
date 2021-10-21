<header>
    <span class="nama">
    <a href="{{ url('/view') }}" class="titl">アメミュ練習室予約システム
    @auth
    （管理者モード）
    @endauth
    </a></span>
    <span class="slbtn">
    @auth
    <a href="{{ route('logout') }}"><button class='yhhb'
        onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">ログアウト</button></a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
    @else
    <a href="{{ route('login') }}"><button class='yhhb'>ログイン</button></a>
    @endauth
    </span>
</header>
