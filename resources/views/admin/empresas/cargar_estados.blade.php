<select name="departamento" id="departamento" class="form-control">
    @foreach($estados as $estado)
        <option value="{{$estado->id}}">{{$estado->name}}</option>
    @endforeach
</select>
