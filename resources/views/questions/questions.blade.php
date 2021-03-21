@extends('layouts.base')

@section('content')
<div class="container">

    <span class="badge bg-primary">問{{ $current_page }}</span>

    @if($current_page == 20)
    <form action="{{route('answer.confirm',['hashed_id'=>$event->hashed_id])}}" method="POST">
        @else
        <form action="{{route('answer.showQuestions',[ 'hashed_id'=>$event->hashed_id, 'current_page'=>$current_page + 1])}}" method="POST">
            @endif
            @csrf
            <div class="row justify-content-center">
                <h5 class="py-2 mx-2">{{$question}}</h5>
                @if($current_page == 8)
                <div class="d-flex flex-wrap justify-content-around">
                    @for($i=1;$i<=6;$i++) <div class="input-group p-2 w-50">
                        <input type="radio" name="q{{$current_page}}" value="{{ $i }}" class="btn-check input-item" id="{{ $i }}" autocomplete="off">
                        <label class="btn btn-outline-primary rounded" for="{{ $i }}">
                            <div class="text-center">
                                <img src="{{ asset('images/fashion_'.$i.'.jpg') }}" class="img-fluid rounded">
                            </div>
                        </label>
                </div>
                @endfor
            </div>
            @elseif($current_page == 11)
            <div class="input-group">
                <select name="q{{$current_page}}" class="form-select">
                    @for($i=140;$i<=180;$i++) <option value={{$i}}>{{$i}}</option>
                        @endfor
                </select>
            </div>

            @elseif($current_page ==19)
            <div class="input-group">
                <select name="q{{$current_page}}" class="form-select">
                    @for($i=0;$i<=20;$i++) <option value={{$i}}>{{$i}}</option>
                        @endfor
                </select>
            </div>
            @else
            <div class="row">
                @foreach($options as $key => $option)
                <div class="input-group p-1">
                    <input type="radio" name="q{{$current_page}}" value={{$key}} class="btn-check input-item w-100" id={{$key}} autocomplete="off">
                    <label class="btn btn-outline-primary w-100 rounded" for={{$key}}>{{$option}}</label>
                </div>
                @endforeach
            </div>

            @endif
            <div class="row justify-content-center py-5">
                <button type="submit" class="btn btn-primary col-4">送信する</button>
            </div>
</div>
</form>
</div>
@endsection