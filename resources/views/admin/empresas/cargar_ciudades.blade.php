<select name="ciudad" id="ciudad" class="form-control">
    @foreach($ciudades as $ciudade)
        <option value="{{$ciudade->id}}">{{$ciudade->name}}</option>
    @endforeach
</select>

