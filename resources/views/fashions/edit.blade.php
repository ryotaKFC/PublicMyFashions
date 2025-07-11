@extends('layouts.app')
@section('content')
@include('commons.errors')
<form action="{{ route('fashions.update', $fashion) }}" method="post">
    @method('patch')
    <div>
        @include('components.form')
    </div>
    <div>
        <button type="submit" class="create_btn">更新する</button>
    </div>
    <div>
        <a href="{{ route('fashions.show', $fashion) }}">キャンセル</a>
    </div>
</form> 
@endsection()
<style>
    .create_btn {
        margin: 30px;
        text-align: center;
        border-radius: 8px;
    }
    .create_btn {
        display: inline-block;
        border: none;
        background-color:#191970;
        padding: 10px 20px;
        color: #ffffff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }
</style>
