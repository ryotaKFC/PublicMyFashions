<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="/css/app.css"> -->
</head>
<body>
    <header class="primary-color">
        <!-- ハンバーガーメニュー -->
        <div class="header-left">
            <button id="menu-btn">≡</button>
            <!-- サイドメニュー -->
            <nav id="side-menu">
                <ul>
                    @if (Auth::check())
                        <li><a href="{{ route('home') }}">HOME</a></li>
                        <li><a href="{{ route('fashions.index') }}">ALL</a></li>
                        <li><a href="{{ route('bookmarks') }}">FAVORITE</a></li>
                        <form onsubmit="return confirm('ログアウトしますか？')" action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" id="logout-btn">ログアウト</button>
                        </form>
                    @else
                        <li><a href="{{ route('login') }}">ログイン</a></li>
                        <li><a href="{{ route('register') }}">新規登録</a></li>
                    @endif
                </ul>
            </nav>
        </div>
        <!-- サイトのタイトル -->
        <div class="header-center">
            <h1><a href="{{ route('home') }}" class="site-title font-georgia">MyFashion</a></h1>
         </div>

    </header>
    <main class="container">

        @yield('content')

    </main>
    <footer>
        &copy; チームブロッコリー制作物
    </footer>
</body>
</html>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuBtn = document.getElementById('menu-btn');
        const sideMenu = document.getElementById('side-menu');

        menuBtn.addEventListener('click', function () {
            sideMenu.classList.toggle('open');
        });

        document.addEventListener('click', function (e) {
            if (!sideMenu.contains(e.target) && e.target !== menuBtn) {
                sideMenu.classList.remove('open');
            }
        });
    });
</script>
<style>
    /* 日本語フォント */
    /* @import url('https://fonts.googleapis.com/css2?family=Itim&family=Zen+Maru+Gothic&display=swap'); */
    /* 英語フォント */
    /* @import url('https://fonts.googleapis.com/css2?family=Itim&display=swap'); */

    /* サイトのテーマカラー */

        /* 背景色 */
        body {
            /* アリスブルー */
            background-color: #f0f8ff; 
        }
        /* カレンダーの背景 */
        .fc-scrollgrid-sync-table {
            background-color:rgb(255, 255, 255);
        }
        /* メインのカラー */
        .primary-color {
            background-color:rgb(18, 39, 83);
        }
        /* セカンダリカラー */


    /* サイト全体設定 */
    body{
        margin: 0;
    }
    .font-georgia {
        font-family: 'Georgia', serif;
    }
    a:link{
       color:#0e4a12;
    }
    button:hover,
    a:hover {
        opacity: 0.8;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        align-content: center;
        text-align: center;
        margin: auto;
    }
    /* 写真のスタイル */
    .fashion-photo img{
        height:100%;
        object-fit:cover;
        border-radius:8px;
    }

    /* ヘッダー部 */
    header {
        height: 100px; 
        padding: 0 10px;
        border-bottom: 1px solid #ccc; 
        /* background-color:rgb(59, 116, 231); */
        color: #ffffff;
        display: flex;
        text-align: center;
    }


    .page-header{
        text-align: center;
        color:#000000;
        
    }
    .your-name{
        text-align: center;
        color:#000000;
    }

    .site-title:visited,
    .site-title:link
    {
        text-decoration: none;
        color:rgb(255, 255, 255);
    }


    /* フッター */
    footer {
        padding: 30px;
        text-align: center;
        font-size: .9rem;
        color: #777;
    }


    /* ハンバーガーメニュー */
    #menu-btn {
        font-size: 2em;
        background-color: rgba(0, 0, 0, 0);
        border: 0px; 
        border-radius: 1px;
        cursor: pointer;
        color: rgb(255, 255, 255);
        margin: auto 0;
        padding: 0;
    }
    .header-left {
        font-size: 2rem;
        flex:.5;
        position: relative;
        top: 5px; 
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }
    #side-menu {
        position: fixed;
        top: 0;
        left: -200px; /* 最初は隠す */
        width: 150px;
        height: 100%;
        background: #222;
        overflow-y: auto;
        transition: left 0.3s ease;
        z-index: 1000;
        padding: 20px;
    }
    #side-menu a, #side-menu button {
        color: rgb(255, 255, 255);
        text-decoration: none;
        background: none;
        border: none;
        font-size: 16px;
        cursor: pointer;
    }
    .header-center {
        font-size: 1.3rem;
        color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    /* メニューを表示 */
    #side-menu.open {
        left: 0;
    }
    /* メニューの各アイテムの設定 */
    #side-menu ul {
        list-style: none;
        padding: 0;
    }

    #side-menu li {
        margin-bottom: 15px;
    }
    
    #side-menu li a:hover,
    #side-menu li button:hover{
        color: rgba(255, 255, 255, 0.4);
    }

    #logout-btn {
        color: rgb(255, 255, 255);
        position: absolute;
        bottom: 30px;
        left: 25%;
        padding-bottom: 40px;
    }
</style>
