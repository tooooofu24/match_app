問9<br>
白い薔薇と赤い薔薇を使って相手に花束を作りましょう<br>
バラの本数は合計20本にしてください<br>
白い薔薇は何本にしますか？<br>
<form action="{{route('answer.confirm',['hashed_id'=>$event->hashed_id])}}" method="POST">
    @csrf
    <select name="q9">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
    </select>
    <input type="submit" value="送信">
</form>