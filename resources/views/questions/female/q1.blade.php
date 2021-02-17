問1<br>
趣味はなんですか？<br>
<form action="{{route('answer.showQuestions',[ 'hashed_id'=>$event->hashed_id, 'current_q'=>2])}}" method="POST">
    @csrf
    <button type="submit" name="q1" value="1">
        <font size="5">映画鑑賞</font>
    </button>
    <button type="submit" name="q1" value="2">
        <font size="5">スポーツ</font>
    </button>
    <button type="submit" name="q1" value="3">
        <font size="5">読書</font>
    </button>
    <button type="submit" name="q1" value="4">
        <font size="5">SNS</font>
    </button>
    <button type="submit" name="q1" value="5">
        <font size="5">音楽</font>
    </button>
    <button type="submit" name="q1" value="6">
        <font size="5">ゲーム</font>
    </button>
</form>