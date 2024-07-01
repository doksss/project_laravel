<!-- Extends ini file blade php mau ditempel ke mana -->
@extends('layout.conquer')
@section('content')
<form method="post" action="{{route('product.update',$data->id)}}">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="ProductName">Name of Product</label>
        <input type="text" class="form-control" id="exampleInputProductName" aria-describedby="nameProduct" placeholder="Enter Name Of Product" name="name_product"
        value="{{$data->name}}">
        <small id="nameHelp" class="form-text text-muted">Please write down the name of product here.</small><br><br>
        <label for="ProductPrice">Price of Product</label>
        <input type="text" class="form-control" id="exampleInputProductPrice" placeholder="Enter Product Price" name="price_product" value="{{$data->price}}">
        <small id="priceHelp" class="form-text text-muted">Please write down the price of product here.</small><br><br>

        <label for="hotel">Choose Hotel Name:</label>
        <select name="hotel_product" id="hotels">
            @foreach ($hotel as $h)
            <option 
                @if($data->hotel->id == $h->id)
                selected
                @endif
                value='{{$h->id}}'>{{$h->name}}</option>
            @endforeach
        </select>
        

        <br><br>
        <label for="ProductImage">Image of Product</label>
        <input type="text" class="form-control" id="ProductImage" placeholder="Enter Image Of Product" name="image_product" value="{{$data->image}}">
        <small id="imageHelp" class="form-text text-muted">Please write down the image of product here.</small><br><br>

        <label for="ProductAvailable">Available Room</label>
        <input type="text" class="form-control" id="AvailableRoom" placeholder="Enter Total Available Room" name="available_room" value="{{$data->available_room}}">
        <small id="RoomHelp" class="form-text text-muted">Please write down the Total of Available Room here.</small><br><br>

    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection