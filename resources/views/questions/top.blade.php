{{$event->name}}の回答画面<br>
<form action="{{route('answer.showQuestions',['hashed_id'=>$event->hashed_id, 'current_q'=>1 ])}}" method="POST">
    @csrf
    <div>
        <label>お名前</label><br>
        <input type="text" name="nickname" /><br>
        <label>性別</label><br>
        <select name="gender">
            <option value="0">選択してください</option>
            <option value="1">男性</option>
            <option value="2">女性</option>
        </select>
        <br><label>学年</label><br>
        <select name="grade">
            <option value="0">選択してください</option>
            <option value="1">1年生</option>
            <option value="2">2年生</option>
            <option value="3">3年生</option>
            <option value="4">4年生</option>
    </div>
    <br>
    <div>
        <input type="submit" value="次へ" />

    </div>
</form>