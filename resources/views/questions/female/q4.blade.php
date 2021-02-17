問4<br>
高校時代の部活は？<br>
<form action="{{route('answer.showQuestions',['hashed_id'=>$event->hashed_id, 'current_q'=>5])}}" method="POST">
    @csrf
    <button type="submit" name="q4" value="1">
        <font size="5">運動部</font>
    </button>
    <button type="submit" name="q4" value="2">
        <font size="5">文化部</font>
    </button>
</form>