@extends('layouts.base')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1 class="text-center">イベント一覧</h1>
        <ul class="list-group list-group-flush col-10">
            @foreach($events as $event)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href='{{action('EventController@confirmEvent',$event->id)}}'>{{$event->name}}</a>
            </li>
            @endforeach
        </ul>
        <a class="btn btn-primary col-6 my-4" href="{{action('EventController@create')}}" role="button">イベント新規作成</a>
    </div>
</div>



@endsection