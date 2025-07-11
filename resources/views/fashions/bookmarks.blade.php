@extends('layouts.app')
@section('content')
<h1 class="page-heading">お気に入りのコーデ</h1>

<div id="fashions">
    @foreach ($fashions as $fashion)
    @if ($fashion->user_id != Auth::user()->id)
    @continue
    @else
    <fashion class="fashion-item">
        <div class="fashion-photo">
            <!-- お気に入りボタン -->
            <div class="favorite-btn">
                @if (!Auth::user()->is_bookmark(fashionId: $fashion->id))
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
            <!-- ファッションの画像 -->
            <a href="{{ route('fashions.show', $fashion) }}">
                <img src="{{ asset('storage/avatar/' . $fashion->photo_path) }}" width="200px">
            </a>
        </div>
        <div class="fashion-info">
            <a class="fashion-info-item" href="{{ route('fashions.index', ['filter' => 'season', 'filter_value' => $fashion->season]) }}">#{{ $fashion->season }}</a>
            <a class="fashion-info-item" href="{{ route('fashions.index', ['filter' => 'weather', 'filter_value' => $fashion->weather]) }}">#{{ $fashion->weather }}</a>
            <a class="fashion-info-item" href="{{ route('fashions.index', ['filter' => 'temperature', 'filter_value' => $fashion->temperature]) }}">#{{ $fashion->temperature }}℃</a>
            <a class="fashion-info-item" href="{{ route('fashions.index', ['filter' => 'humidity', 'filter_value' => $fashion->humidity]) }}">#{{ $fashion->humidity }}%</a>
            <a class="fashion-info-item" href="{{ route('fashions.index', ['filter' => 'luck', 'filter_value' => $fashion->luck]) }}">#{{ $fashion->luck }}</a>
            <a class="fashion-info-item" href="{{ route('fashions.index', ['filter' => 'comment', 'filter_value' => $fashion->comment]) }}">#{{ $fashion->comment }}</a>
        </div>
        <div class="fashion-info-created_at">{{ $fashion->created_at->format('Y-m-d') }}</div>
    </fashion>
    @endif
    @endforeach
</div>


<style>
    #fashions {
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        justify-content: center;
    }

    .fashion-photo img {
        width: 100%;
    }

    .fashion-item {
        width: 300px;
        margin: 20px 20px;
    }

    .fashion-info {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        width: 200px;
        margin: auto;
        justify-content: space-evenly;
    }
    .fashion-info-item,
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
        font-size: 150%;
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
</style>

@endsection
