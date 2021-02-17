問7<br>
あなたが散歩をしていると、可愛らしい子猫を見つけました。<br>
それはどんな子猫ですか？<br>
<form action="{{route('answer.showQuestions',['hashed_id'=>$event->hashed_id, 'current_q'=>8])}}" method="POST">
    @csrf
    <button type="submit" name="q7" value="1">
        <font size="5">こちらをずっと見つめてくる子猫</font>
    </button>
    <button type="submit" name="q7" value="2">
        <font size="5">寄ってきて懐いてくる子猫</font>
    </button>
    <button type="submit" name="q7" value="3">
        <font size="5">小石で遊んでいる子猫</font>
    </button>
    <button type="submit" name="q7" value="4">
        <font size="5">怪我をしている子猫</font>
    </button>
</form>