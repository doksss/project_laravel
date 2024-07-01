<!-- Extends ini file blade php mau ditempel ke mana -->
@extends('layout.conquer')
@section('content')
<form method="post" action="{{route('transaction.store')}}">
    @csrf
    <div class="form-group">
        <!-- <label for="ProductName">Name of Product</label>
        <input type="text" class="form-control" id="exampleInputProductName" aria-describedby="nameProduct" placeholder="Enter Name Of Product" name="name_product">
        <small id="nameHelp" class="form-text text-muted">Please write down the name of product here.</small><br><br>
        <label for="ProductPrice">Price of Product</label>
        <input type="text" class="form-control" id="exampleInputProductPrice" placeholder="Enter Product Price" name="price_product">
        <small id="priceHelp" class="form-text text-muted">Please write down the price of product here.</small><br><br> -->

        <label for="customer">Choose Customer Name:</label>
        <select name="customer_id" id="customers">
            @foreach ($customer as $c)
            <option value='{{$c->id}}'>{{$c->name}}</option>
            @endforeach
        </select><br><br>

        <label for="user">Choose User Name:</label>
        <select name="user_id" id="users">
            @foreach ($user as $u)
            <option value='{{$u->id}}'>{{$u->name}}</option>
            @endforeach
        </select><br><br>

        <label for="product">Choose Product Name:</label>
        <select name="product_id" id="products">
            @foreach ($product as $p)
            <option value='{{$p->id}}'>{{$p->name}}</option>
            @endforeach
        </select>

        <br><br>
        <label for="quantity">Quantity of product</label>
        <input type="text" class="form-control" id="quantityProduct" placeholder="Enter Image Of Product" name="quantity">
        <small id="quantityHelp" class="form-text text-muted">Please write down the amount of quantity product.</small><br><br>

        <label for="subtotal">Sub Total</label>
        <input type="text" class="form-control" id="subtotalProduct" placeholder="Enter Sub Total" name="subtotal">
        <small id="subtotalHelp" class="form-text text-muted">Please write down the SubTotal here.</small><br><br>

    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection