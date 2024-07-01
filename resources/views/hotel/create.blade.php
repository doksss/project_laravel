<!-- Extends ini file blade php mau ditempel ke mana -->
@extends('layout.conquer')
@section('content')
<form method="post" action="{{route('hotels.store')}}">
    @csrf
    <div class="form-group">
        <label for="exampleInputType">Name of Hotel</label>
        <input type="text" class="form-control" id="exampleInputType" aria-describedby="nameHelp" placeholder="Enter Name Of Type" name="hotel_name">
        <small id="nameHelp" class="form-text text-muted">Please write down the name of Hotel here.</small><br><br>
        <label for="descInput">Address of Hotel</label>
        <input type="text" class="form-control" id="descInput" aria-describedby="descHelp" placeholder="Enter Description Of Type" name="hotel_address">
        <small id="descHelp" class="form-text text-muted">Please write down the address of hotel here.</small>
        <input type="text" class="form-control" id="descInput" aria-describedby="descHelp" placeholder="Enter Description Of Type" name="hotel_city">
        <small id="descHelp" class="form-text text-muted">Please write down the city of hotel here.</small><br><br>
        <input type="text" class="form-control" id="descInput" aria-describedby="descHelp" placeholder="Enter Description Of Type" name="hotel_image">
        <small id="descHelp" class="form-text text-muted">Please write down the image of hotel here.</small><br><br>
        <label for="exampleHotelType">Name of Type Hotel</label>
        <select name="hotel_type" id="types">
            @foreach ($type as $t)
            <!-- cara 1 -->
            <option <?php // CARA 1 if ($data->type->id == $t->id)
                        //echo 'selected' ?> 
        
                value='{{$t->id}}'>{{$t->name}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection