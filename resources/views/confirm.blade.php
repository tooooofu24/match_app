@extends('layouts.base')

@section('content')

<div class="container">
    <div class="row">
        <span class="badge bg-info">{{$event->name}}</span>
        <div class="center py-3">
            <h3 class="text-center">回答者一覧</h3>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item col-3 text-center">学年</li>
                <li class="list-group-item col-3 text-center">性別</li>
                <li class="list-group-item flex-fill text-center">回答者氏名</li>
            </ul>
            @foreach($answers as $answer)
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item col-3 text-center">{{$answer->grade}}</li>
                @if($answer->gender == 1)
                <li class="list-group-item col-3 text-center">男</li>
                @elseif($answer->gender == 2)
                <li class="list-group-item col-3 text-center">女</li>
                @endif
                <li class="list-group-item flex-fill text-center">{{$answer->nickname}}</li>
            </ul>
            @endforeach
        </div>
        <div class="center py-3">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item col-3 text-center">男性</li>
                <li class="list-group-item col-3 text-center">女性</li>
                <li class="list-group-item flex-fill text-center">回答者合計</li>
            </ul>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item col-3 text-center">{{ count($answers->where('gender',1)) }}人</li>
                <li class="list-group-item col-3 text-center">{{ count($answers->where('gender',2)) }}人</li>
                <li class="list-group-item flex-fill text-center">{{ count($answers) }}人</li>
            </ul>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="addon-wrapping">回答用URL</span>
            <input type="text" class="form-control" value="/questions/{{$event->hashed_id}}" onfocus="this.select();" aria-describedby="answer_page" id="answer_page" readonly>
            <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard()">コピー</button>
        </div>
        @if($event->outputed == 0)
        <form action="{{route('event.getResult',['id'=>$event->id])}}" method="GET">
            <div class="row justify-content-center py-5">
                <button type="submit" class="btn btn-primary col-4">結果を出力する</button>
            </div>
        </form>

        @elseif($event->outputed ==1)
        <div class="row justify-content-center py-5">
            <button type="submit" class="btn btn-primary col-4" disabled>結果を出力済みです</button>
        </div>
        <a class="text-center" href="/questions/{{$event->hashed_id}}/results/show">マッチ結果一覧</a>
        @endif

    </div>
</div>
<script>
    function copyToClipboard() {
        // コピー対象をJavaScript上で変数として定義する
        var copyTarget = document.getElementById("answer_page");

        // コピー対象のテキストを選択する
        copyTarget.select();

        // 選択しているテキストをクリップボードにコピーする
        document.execCommand("Copy");
    }
</script>

@endsection