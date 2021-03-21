@extends('layouts.base')

@section('content')

<div class="container">
    <h3 class="text-center p-2">回答者一覧</h3>
    <div class="accordion" id="accordion">

        @for($i=1; $i<=20; $i++) <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{$i}}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}" aria-expanded="false" aria-controls="collapse{{$i}}">
                    @if(is_array($questions[$i]))
                    問{{ $i }}. {{ $questions[$i]['male'] }}/{{ $questions[$i]['female'] }}
                    @else
                    問{{ $i }}. {{ $questions[$i] }}
                    @endif
                </button>
            </h2>
            <div id="collapse{{$i}}" class="accordion-collapse collapse" aria-labelledby="heading{{$i}}" data-bs-parent="#accordion">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content: space-around">
                            <div class="col-6">
                                {{ $male->nickname }}<br>
                                <strong>
                                    @if($i == 8)
                                    ８
                                    @elseif($i == 11)
                                    １１
                                    @elseif($i == 19)
                                    １９
                                    @else
                                    @if(array_values($options[$i]) === $options[$i])
                                    『{{ $options[1][$male->q1] }}』
                                    @else
                                    『{{ $options[10]['male'][$male->q10] }}』
                                    @endif
                                    @endif
                                </strong>
                            </div>
                            <div class="col-6">
                                {{ $female->nickname }}<br>
                                <strong>
                                    『{{ $options[1][$female->q1] }}』
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        説明が入ります
                    </div>
                </div>
            </div>
    </div>
    @endfor

    <!-- ここまで -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                アコーディオン・アイテム #2
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
            <div class="accordion-body">
                <strong>これは2番目のアイテムのアコーディオン本体。</strong>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                アコーディオン・アイテム #3
            </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordion">
            <div class="accordion-body">
                <strong>これは3番目のアイテムのアコーディオン本体。</strong>
            </div>
        </div>
    </div>
</div>
</div>

@endsection