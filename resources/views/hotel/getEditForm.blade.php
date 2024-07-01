<form method="post" action="{{route('hotels.update',$data->id)}}">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="exampleInputType">Name of Hotel</label>
        <input type="text" class="form-control" id="exampleInputType" aria-describedby="nameHelp" placeholder="Enter Name Of Hotel" name="hotel_name" value="{{$data->name}}">
        <small id="nameHelp" class="form-text text-muted">Please write down the name of Hotel here.</small><br>
        <label for="descInput">Address of Hotel</label>
        <input type="text" class="form-control" id="descInput" aria-describedby="descHelp" placeholder="Enter Address Of Hotel" name="hotel_address" value="{{$data->address}}">
        <small id="descHelp" class="form-text text-muted">Please write down the address of hotel here.</small><br>
        <label for="descInput">Number Phone of Hotel</label>
        <input type="text" class="form-control" id="descInput" aria-describedby="descHelp" placeholder="Enter num Of Hotel" name="hotel_phone" value="{{$data->nomor_telepon}}">
        <small id="descHelp" class="form-text text-muted">Please write down the number phone of hotel here.</small><br>
        <label for="descInput">Email of Hotel</label>
        <input type="text" class="form-control" id="descInput" aria-describedby="descHelp" placeholder="Enter num Of Hotel" name="hotel_email" value="{{$data->email}}">
        <small id="descHelp" class="form-text text-muted">Please write down the email of hotel here.</small><br>
        <label for="exampleHotelType">Name of Type Hotel</label>
        <select name="hotel_type" id="types">
            @foreach ($type as $t)
            <!-- cara 1 -->
            <option <?php // CARA 1 if ($data->type->id == $t->id)
                    //echo 'selected' 
                    ?> @if($data->type->id == $t->id)
                selected

                @endif
                value='{{$t->id}}'>{{$t->name}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>