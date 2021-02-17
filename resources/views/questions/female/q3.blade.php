問3<br>
一番興味のある占いはどれ？<br>
<form action="{{route('answer.showQuestions',['hashed_id'=>$event->hashed_id, 'current_q'=>4])}}" method="POST">
    @csrf
    <button type="submit" name="q3" value="1">
        <font size="5">星占い</font>
    </button>
    <button type="submit" name="q3" value="2">
        <font size="5">風水</font>
    </button>
    <button type="submit" name="q3" value="3">
        <font size="5">タロット</font>
    </button>
    <button type="submit" name="q3" value="4">
        <font size="5">前世占い</font>
    </button>
</form>