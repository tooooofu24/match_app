@extends('layouts.base')

@section('content')

<div class="container">
    <div class="row">
        <h1 class="text-center">マッチ結果一覧</h1>
        <div class="row justify-content-center">
            <ul class="list-group list-group-flush col-10">
                @foreach($results as $result)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="center text-center">
                        {{$answers->where('id',$result->male)->first()->nickname}}
                        ♡
                        {{$answers->where('id',$result->female)->first()->nickname}}
                        @if($result->remainder)
                        ♡
                        {{$answers->where('id',$result->remainder)->first()->nickname}}
                        @endif
                    </div>
                    <a class="badge bg-primary rounded-pill" href="/questions/{{$event->hashed_id}}/results/show/{{$result->id}}">詳細を見る</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection