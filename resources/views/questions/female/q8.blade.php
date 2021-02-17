問8<br>
あなたは異性の友達にマグカップをプレゼントしようと思っています。<br>
次の四色のうち、何色を渡しますか？<br>
<form action="{{route('answer.showQuestions',['hashed_id'=>$event->hashed_id, 'current_q'=>9])}}" method="POST">
    @csrf
    <button type="submit" name="q8" value="1">
        <font size="5">緑</font>
    </button>
    <button type="submit" name="q8" value="2">
        <font size="5">オレンジ</font>
    </button>
    <button type="submit" name="q8" value="3">
        <font size="5">青</font>
    </button>
    <button type="submit" name="q8" value="4">
        <font size="5">ピンク</font>
    </button>
</form>