@extends('layouts.app')
@section('content')
<h1>ログイン</h1>
@include('commons.errors')
<div class="form-section">
    <div>
        <form action="{{ route('login') }}" method="post">
            @csrf 
            <dl class="form-list">
            <dt>メールアドレス</dt>
            <!-- <dd><input type="email" name="email" value="{{ old('email') }}"></dd> -->
            <dd><input type="email" name="email" value="yasai@yasai.com"></dd>
            <dt>パスワード</dt>
            <!-- <dd><input type="password" name="password"></dd> -->
            <dd><input type="password" name="password" value="83101417"></dd>
        </dl>
    </div>
    <div>
        <button type="submit" class="submit-btn">ログイン</button>
    </div>
    <div>
        <a href="/">キャンセル</a>
    </div>
</form>
</div>
@endsection()

<style>
    .form-section {
        display: flex;
        flex-direction: column;
    }
    /* フォーム全体 */
    .form-list {
    display: inline-block;
    background-color: #e6f4ff;
    padding: 30px;
    border-radius: 20px;
    /* box-shadow: 0 0 10px #a3d8ff; */
    text-align: left;
    margin-bottom: 40px;
    }

    .form-list dt {
    font-weight: bold;
    margin-top: 15px;
    color: #1a73e8;
    }

    .form-list dd {
    margin-bottom: 10px;
    }

    input[type="file"],
    input[type="number"],
    select {
    width: 100%;
    padding: 6px 12px;
    border-radius: 10px;
    border: 1px solid #bbb;
    background: #fff;
    font-size: 1em;
    box-sizing: border-box;
    margin: 5px 0 10px;
    }

    /* ボタンエリア */
    .submit-btn {
    text-align: right;
    margin: 25px;
    padding-right: 10px;
    }

    /* 送信ボタン */
    .submit-btn {
    background-color: #1e3a8a;
    color: white;
    font-weight: bold;
    font-size: 1rem;
    padding: 12px 25px;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .submit-btn:hover {
    background-color: #162d6d;
    transform: translateY(-2px);
    }

    /* リンクボタン */
    .form-buttons a {
    margin-left: 15px;
    padding: 8px 16px;
    border-radius: 20px;
    background-color: #e0f0ff;
    color: #007acc;
    font-weight: bold;
    text-decoration: none;
    transition: background-color 0.3s ease;
    }

    .form-buttons a:hover {
    background-color: #c0e0ff;
    }
</style>
