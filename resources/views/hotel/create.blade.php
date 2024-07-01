<!-- Extends ini file blade php mau ditempel ke mana -->

@extends('layout.frontend')
@section('content')
<div class="product-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-view-top">
                            <div class="row">
                                <form method="post" action="{{route('hotels.store')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputType">Name of Hotel</label>
                                        <input type="text" class="form-control" id="exampleInputType" aria-describedby="nameHelp" placeholder="Enter Name Of Hotel" name="hotel_name">
                                        <small id="nameHelp" class="form-text text-muted">Please write down the name of Hotel here.</small><br>
                                        <label for="descInput">Address of Hotel</label>
                                        <input type="text" class="form-control" id="descInput" aria-describedby="descHelp" placeholder="Enter Address of Hotel" name="hotel_address">
                                        <small id="descHelp" class="form-text text-muted">Please write down the address of hotel here.</small><br>  
                                        <label for="descInput">Number Phone of Hotel</label>
                                        <input type="text" class="form-control" id="descInput" aria-describedby="descHelp" placeholder="Enter Number phone of hotel" name="hotel_phone">
                                        <small id="descHelp" class="form-text text-muted">Please write down the city of hotel here.</small><br>
                                        <label for="descInput">Email of Hotel</label>
                                        <input type="text" class="form-control" id="descInput" aria-describedby="descHelp" placeholder="Enter Email of Hotel" name="hotel_email">
                                        <small id="descHelp" class="form-text text-muted">Please write down the image of hotel here.</small><br>
                                        <label for="exampleHotelType">Name of Type Hotel</label>
                                        <select name="hotel_type" id="types">
                                            @foreach ($type as $t)
                                            <!-- cara 1 -->
                                            <option <?php // CARA 1 if ($data->type->id == $t->id)
                                                    //echo 'selected' 
                                                    ?> value='{{$t->id}}'>{{$t->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Side Bar End -->
            </div>
        </div>
    </div>
    @endsection