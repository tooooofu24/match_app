イベント作成<br>
<form action="{{url('/events/event/create')}}" method="POST">
    @csrf
    <div>
        <label>イベント名</label><br>
        <input type="text" name="name" />
    </div>
    <div>
        <input type="hidden" name="user_id" value={{$user_id}}>
        <input type="hidden" name="hashed_id" value="{{Hash::make(time())}}" />
        <input type="submit" value="作成" />

    </div>
</form>