@extends('layouts.app')
@section('content')
<div class="welcome">
    <h1>My Fashions</h1>
    @auth
    <a class="btn" href="{{ route('home') }}">ホームへ</a>
    <a class="btn" href="{{ route('fashions.index') }}">コーデを見る</a>
    @else
    <a class="btn primary-color" href="{{ route('register') }}">会員登録</a>
    <a class="btn primary-color" href="{{ route('login') }}">ログイン</a>
    @endauth
</div>
@endsection() 

<style>
a {
  all: unset;
  cursor: pointer;
}

.btn {
  margin: 30px;
  padding: 10px 10px;
  text-align: center;
}

/* ボタンの見た目 */
.btn:visited,
.btn:link
 {
  display: inline-block;
  border: none;
  background-color: #191970; /* ミッドナイトブルー */
  padding: 10px 20px;
  color: #ffffff;
  text-decoration: none;
  border-radius: 8px;
  font-weight: bold;
  transition: background-color 0.3s ease;
}

/* ホバー時に色を変える */
.btn a:hover {
  background-color: #4169e1; /* ロイヤルブルー */
}

 .btn{
  margin: 30px;
  color:#fff;
  font-size:1.2rem;
  text-align: center;
  border-radius: 8px;
 }
 .btn a {
    display: inline-block;
    border: none;
    background-color:#191970;
    padding: 20px 40px;
    color: #ffffff;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    transition: background-color 0.3s ease;
    }
.btn a:hover {
  /* background-color: #777;  */
}
</style>
