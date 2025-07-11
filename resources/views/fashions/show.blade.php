@extends('layouts.app')
@section('content')
<section class="fashion-detail">
    <!-- コーデの詳細の表示 -->
    <div class="fashion-photo">
        <!-- お気に入りボタンの処理 -->
        <div class="favorite-btn"> 
            @if (!Auth::user()->is_bookmark($fashion->id))
                <form action="{{ route('bookmark.store', $fashion) }}" method="post">
                    @csrf
                    <button>☆</button>
                </form>
                @else 
                <form action="{{ route('bookmark.destroy', $fashion) }}" method="post">
                    @csrf
                    @method('delete')
                    <button>★</button>
                </form>
            @endif
        </div>
        <img src="{{ asset('storage/avatar/' . $fashion->photo_path) }}" alt="コーデ画像">
    </div>
    <!-- fashion-info -->
        <div class="fashion-info">
            <a class="fashion-info-item" href="{{ route('fashions.index', ['filter' => 'season', 'filter_value' => $fashion->season]) }}">#{{ $fashion->season }}</a>
            <a class="fashion-info-item" href="{{ route('fashions.index', ['filter' => 'weather', 'filter_value' => $fashion->weather]) }}">#{{ $fashion->weather }}</a>
            <a class="fashion-info-item" href="{{ route('fashions.index', ['filter' => 'temperature', 'filter_value' => $fashion->temperature]) }}">#{{ $fashion->temperature }}℃</a>
            <a class="fashion-info-item" href="{{ route('fashions.index', ['filter' => 'humidity', 'filter_value' => $fashion->humidity]) }}">#{{ $fashion->humidity }}%</a>
            <a class="fashion-info-item" href="{{ route('fashions.index', ['filter' => 'luck', 'filter_value' => $fashion->luck]) }}">#{{ $fashion->luck }}</a>
            <a class="fashion-info-item" href="{{ route('fashions.index', ['filter' => 'comment', 'filter_value' => $fashion->comment]) }}">#{{ $fashion->comment }}</a>
        </div>
    <div class="fashion-info-created_at">{{ $fashion->created_at->format('Y-m-d') }}</div>

    <div class="fashion-control">
        @if (Auth::user()->email == "yasai@yasai.com")
            <form onsubmit="return confirm('このアカウントでは無効にしてます')">
        @else
            <form action="{{ route('fashions.edit', $fashion) }}" method="get">
        @endif
            @csrf    
            <button class="edit-btn">✏️編集</button>
            </form>

        @if (Auth::user()->email == "yasai@yasai.com")
            <form onsubmit="return confirm('このアカウントでは無効にしてます')">
        @else
            <form action="{{ route('fashions.destroy', $fashion) }}" method="post">
        @endif
            @csrf
            @method('delete')
            <button class="destroy-btn">🗑️削除</button>
            </form>
    </div>
</section>

<style>
    /* 今日の服装登録ボタン */
    .fashion-control button{
        margin: 30px;
        text-align: center;
        border-radius: 8px;
    }
    .fashion-control button {
        display: inline-block;
        padding: 10px 20px;
        color: #ffffff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: background-color 0.3s ease;
        border: none;
    }

    /* #create-button a:hover {
        background-color:#777 ;
    } */


    .fashion-photo {
        width: 400px;
        margin: 40px;
    }
    .fashion-photo img{
        width:100%;
        height:100%;
        object-fit:cover;
        border-radius:8px;
    }

.fashion-info {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        width: 200px;
        margin: auto;
        justify-content: space-evenly;
    }
    .fashion-info-item:link,
    .fashion-info-item:visited {
        color:rgb(65, 142, 230);
        text-decoration: none;
        margin: 1px 3px;
    }

    /* お気に入りボタンのスタイル */
    .favorite-btn button {
        background-color: rgba(0, 0, 0, 0);
        color: rgb(234, 234, 41);
        font-size: 2.5rem;
        font-style: initial;
        border: 0px;
        -webkit-text-stroke: 1.5px rgb(255, 255, 255);
        paint-order: stroke;
    }

    /* お気に入りボタン左上にする処理 */
    .fashion-photo {
        position: relative;
        display: inline-block;
    }
    .favorite-btn {
        position: absolute;
        top: 0px;
        left: 0px;
        z-index: 2;
    }

    /* 編集、削除ボタン */
    .fashion-control {
        margin: 5px 20px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;   
        border: 1px;
    }

    .fashion-control button {
        color: transparent;
        text-decoration: none;  
        margin: 0 10px;
        cursor : pointer;
    }
    .edit-btn{
        text-shadow: 0 0 0 black;
    }
    .destroy-btn {
        text-shadow: 0 0 0 red;
    }
    
</style>
@endsection
