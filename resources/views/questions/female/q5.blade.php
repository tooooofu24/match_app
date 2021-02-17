問5<br>
一番興味のある占いはどれ？<br>
<form action="{{route('answer.showQuestions',['hashed_id'=>$event->hashed_id, 'current_q'=>6])}}" method="POST">
    @csrf
    <button type="submit" name="q5" value="1">
        <font size="5">自宅まで走って帰る</font>
    </button>
    <button type="submit" name="q5" value="2">
        <font size="5">駅の売店で傘を買う</font>
    </button>
    <button type="submit" name="q5" value="3">
        <font size="5">迎えを頼む</font>
    </button>
    <button type="submit" name="q5" value="4">
        <font size="5">雨宿りをする</font>
    </button>
</form>