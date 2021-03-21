@extends('layouts.base')

@section('content')

<div class="container">
    <h4>
        回答を送信します。<br>
        よろしいですか？
    </h4>
    <form action="{{ route('answer.store',['hashed_id'=>$event->hashed_id]) }}" method="POST">
        @csrf
        <div class="row justify-content-center py-5">
            <button type="submit" class="btn btn-primary col-4">送信する</button>
        </div>
    </form>

</div>

@endsection