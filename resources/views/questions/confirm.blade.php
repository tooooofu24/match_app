回答を送信します。<br>
よろしいですか？<br>
<form action="{{ route('answer.store',['hashed_id'=>$event->hashed_id]) }}" method="POST">
    @csrf
    <input type="submit" value="送信">
</form>