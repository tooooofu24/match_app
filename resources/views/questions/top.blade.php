{{$event->name}}の回答画面<br>
<form action="" method="POST">
    @csrf
    <div>
        <label>お名前</label><br>
        <input type="text" name="nickname" />
        <label>性別</label><br>
        <select name="gender">
            <option value="0">選択してください</option>
            <option value="1">男性</option>
            <option value="2">女性</option>
        </select>
        <label>学年</label><br>
        <select name="gender">
            <option value="0">選択してください</option>
            <option value="1">1年生</option>
            <option value="2">2年生</option>
            <option value="3">3年生</option>
            <option value="4">4年生</option>
    </div>
    <div>
        <input type="submit" value="次へ" />

    </div>
</form>