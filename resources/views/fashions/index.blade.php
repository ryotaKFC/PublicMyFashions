@extends('layouts.app')
@section('content')
<h1 class="page-heading">コーデ検索</h1>
@include('components.sort_and_filter')
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
    </fashion>
    @endif
    @endforeach
</div>


<style>
    #fashions {
        width: 90%;
        margin: auto;
        display: flex;
        flex-direction: row;
        justify-content: center;
        flex-wrap: wrap;
    }
    .fashion-photo img {
        width: 100%;
        height: 200px;
        object-fit:cover;
        border-radius:8px;
    }

    .fashion-item {
        margin: 20px 5px;
        max-width: 150px;
    }

    .fashion-info {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        width: 200px;
        margin: auto;
        justify-content: space-evenly;
        color:rgb(65, 142, 230);
    }
    .fashion-info-item {
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


