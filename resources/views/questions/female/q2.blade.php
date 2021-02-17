問2<br>
あなたが彼氏にもらって一番嬉しいクリスマスプレゼントはどれ？<br>
<form action="{{route('answer.showQuestions',['hashed_id'=>$event->hashed_id, 'current_q'=>3])}}" method="POST">
    @csrf
    <button type="submit" name="q2" value="1">
        <font size="5">服や靴などの<br>ファッションアイテム</font>
    </button>
    <button type="submit" name="q2" value="2">
        <font size="5">指輪やネックレスなどの<br>アクセサリー</font>
    </button>
    <button type="submit" name="q2" value="3">
        <font size="5">ハイブランドの<br>財布やバッグ</font>
    </button>
    <button type="submit" name="q2" value="4">
        <font size="5">一緒に居られれば<br>なんでもいい</font>
    </button>
</form>