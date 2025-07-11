@extends('layouts.app')
@section('content')

<section class="page-header">
    <h1>ホーム</h1>
</section>
<p class="your-name">ようこそ、{{ Auth::user()->name }}さん</p>

<!-- カレンダー -->
@include('components.calendar')
<!-- コーデ登録ボタン -->
<div  class="primary-color" id="create-button"><a href="{{ route('fashions.create') }}">今日のコーデ登録</a></div>


<style>
    /* 今日の服装登録ボタン */
    #create-button {
        margin: 30px;
        text-align: center;
        border-radius: 8px;

    }
    #create-button a {
        display: inline-block;
        padding: 10px 20px;
        color: #ffffff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }
    #create-button a:hover {
        background-color:#777 ; /* ホバー時の色 */
    }
</style>
@endsection
