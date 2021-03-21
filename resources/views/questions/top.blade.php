@extends('layouts.base')

@section('content')

<div class="container">
    <div class="row">
        <h1 class="text-center">{{$event->name}}の回答画面</h1>
        <form action="{{route('answer.showQuestions',['hashed_id'=>$event->hashed_id, 'current_page'=>1 ])}}" method="POST">
            @csrf
            <div class="input-group  mt-5 pb-3">
                <span class="input-group-text" id="basic-addon1">お名前</span>
                <input type="text" name="nickname" class="form-control" placeholder="とーや" aria-describedby="basic-addon1">
            </div>
            <div class="input-group py-3">
                <label class="input-group-text" for="inputGroupSelect01">性別</label>
                <select name="gender" class="form-select" id="inputGroupSelect01">
                    <option selected value=0>選択してください</option>
                    <option value=1>男性</option>
                    <option value=2>女性</option>
                </select>
            </div>
            <div class="input-group py-3">
                <label class="input-group-text" for="inputGroupSelect02">学年</label>
                <select name="grade" class="form-select" id="inputGroupSelect02">
                    <option selected value=0>選択してください</option>
                    <option value=1>1年生</option>
                    <option value=2>2年生</option>
                    <option value=3>3年生</option>
                    <option value=4>4年生</option>
                </select>
            </div>
            <div class="row justify-content-center py-5">
                <button type="submit" class="btn btn-primary col-4">送信する</button>
            </div>
        </form>
    </div>
</div>
@endsection