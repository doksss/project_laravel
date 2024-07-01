@section('content')
<form method="post" action="{{route('transaction.update',$data->id)}}">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="customer">Choose Customer Name:</label>
        <select name="customer_id" id="customers">
            @foreach ($customer as $c)
            <option @if($data->customer_id == $c->id)
                selected
                @endif
                value='{{$c->id}}'>{{$c->name}}</option>
            @endforeach
        </select><br><br>

        <label for="user">Choose User Name:</label>
        <select name="user_id" id="users">
            @foreach ($user as $u)
            <option @if($data->user_id == $u->id)
                selected
                @endif
                value='{{$u->id}}'>{{$u->name}}</option>
            @endforeach
        </select><br><br>

        <label for="product">Choose Product Name:</label>
        <select name="product_id" id="products">
            @foreach ($product as $p)
            
            <option @if($data->products->first()->id == $p->id)
                selected
                @endif
                value='{{$p->id}}'>{{$p->name}}</option>
            @endforeach
        </select>

        <br><br>
        <label for="quantity">Quantity of product</label>
        <input type="text" class="form-control" id="quantityProduct" placeholder="Enter Quantity Of Product" name="quantity" value="{{$data->products->first()->pivot->quantity}}">
        <small id="quantityHelp" class="form-text text-muted">Please write down the amount of quantity product.</small><br><br>

        <label for="subtotal">Sub Total</label>
        <input type="text" class="form-control" id="subtotalProduct" placeholder="Enter Sub Total" name="subtotal" value="{{$data->products->first()->pivot->subtotal}}">
        <small id="subtotalHelp" class="form-text text-muted">Please write down the SubTotal here.</small><br><br>

    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>