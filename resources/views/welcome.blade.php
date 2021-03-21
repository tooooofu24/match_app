@extends('layouts.base')

@section('content')

<div class="container">
    <div class="fullscreen w-100">
        <div class="row">
            <div class="display-1 text-center">
                Tatch
            </div>

            @if (Route::has('login'))
            @auth
            <div class="text-center">
                <a class="btn btn-outline-primary" href="{{ url('/events') }}" role="button">イベント一覧へ</a>
            </div>
            @else
            @if (Route::has('register'))
            <div class="text-center">
                <a class="btn btn-outline-primary" href="{{ route('register') }}" role="button">新規登録</a>
                @endif
                <a class="btn btn-outline-primary" href="{{ route('login') }}" role="button">ログイン</a>
            </div>

            @endauth
            @endif
        </div>
    </div>
</div>

@endsection