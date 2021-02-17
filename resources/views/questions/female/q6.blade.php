問6<br>
あなたの性格や状態を四字熟語で表すとしたら、次のうちどれ？<br>
<form action="{{route('answer.showQuestions',['hashed_id'=>$event->hashed_id, 'current_q'=>7])}}" method="POST">
    @csrf
    <button type="submit" name="q6" value="1">
        <font size="5">天真爛漫</font>
    </button>
    <button type="submit" name="q6" value="2">
        <font size="5">研究熱心</font>
    </button>
    <button type="submit" name="q6" value="3">
        <font size="5">知覚過敏</font>
    </button>
    <button type="submit" name="q6" value="4">
        <font size="5">疲労困憊</font>
    </button>
</form>