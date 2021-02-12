<a href="{{action('EventController@create')}}">イベント新規作成</a>
<ul>
    @foreach($events as $event)
    <li>{{$event->name}}:<a href='{{action('EventController@confirmEvent',$event->id)}}'>詳細</a></li>
    @endforeach
</ul>