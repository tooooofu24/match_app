@extends('layouts.base')

@section('content')

<div class="container">
    <div class="row">
        <div class="center">
            <h3 class="text-center">イベント作成</h3>
            <form action="{{url('/events/event/create')}}" method="POST">
                @csrf
                <div class="input-group  mt-5 pb-3">
                    <span class="input-group-text" id="basic-addon1">イベント名</span>
                    <input type="text" name="name" class="form-control" placeholder="入力してください" aria-describedby="basic-addon1">
                </div>
                <input type="hidden" name="user_id" value={{$user_id}}>
                <input type="hidden" name="hashed_id" value="{{ hash('md5', now()) }}" />
                <div class="row justify-content-center py-5">
                    <button type="submit" class="btn btn-primary col-4">作成する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection