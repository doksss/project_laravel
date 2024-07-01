<!-- <ul>
    @foreach ($data as $p)
    
    <li>{{$p->name}} dari <i>{{$p->hotel->name}}</i></li>
    @endforeach
</ul> -->

@extends('layout.conquer')
@section('content')
@if(@session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div class="container">
    <a href="{{route('product.create')}}" class="btn btn-success">+ New Product</a>
    <a href="#modalCreate" data-toggle="modal" class="btn btn-info">+ New Product (With Modals)</a>
    <h2>Daftar Product Setiap Hotel</h2>
    <div class="row">
        @foreach ($data as $p)
        <div class="col-md-4" id="card_{{$p->id}}">
            <div class="card mb-4 box-shadow">
                <!-- <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22508%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20508%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_18e50bfccb4%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A25pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_18e50bfccb4%22%3E%3Crect%20width%3D%22508%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22169.7562484741211%22%20y%3D%22123.78000068664551%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;"> -->
                <!-- <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="{{asset('images/'.$p->image)}}" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;"> -->
                @if($p->filenames)
                @foreach ($p->filenames as $filename)
                <img src="{{asset('products/'.$p->id.'/'.$filename)}}" /><br>
                <form style="display: inline" method="POST" action="{{url('product/delPhoto')}}">
                    @csrf
                    <input type="hidden" value="{{'products/'.$p->id.'/'.$filename}}" name='filepath' />
                    <input type="submit" value="delete" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure ? ');">
                </form>

                @endforeach
                @endif
                <a href="{{ url('product/uploadPhoto/'.$p->id) }}">
                    <button class='btn btn-xs btn-default'>upload</button></a>


                <div class="card-body">
                    <h3>{{$p->name}}</h3>
                    <h4>Available Room: {{$p->available_room}}</h4>
                    <p class="card-text">Ini merupakan product yang ada pada {{$p->hotel->name}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a class="btn btn-warning" href="{{route('product.edit',$p->id)}}">Edit</a>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-warning" href="#modalEditA" data-toggle="modal" onclick="getEditForm({{$p->id}})">Edit Type A</a>
                        </div>
                        <div class="btn-group">
                            <form method="post" action="{{route('product.destroy',$p->id)}}">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" onclick="return confirm('Are you sure?')" class="btn btn-danger"></input>
                            </form>
                        </div>
                        <a class="btn btn-danger" href="#" value="DeleteNoReload" onclick="if(confirm('Are you sure to delete {{$p->id}} - {{$p->name}} ?')) deleteDataRemoveCard({{$p->id}})">Delete without reload</a>
                        <small class="text-muted">Rp. {{$p->price}}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add New Customer</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('product.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="ProductName">Name of Product</label>
                        <input type="text" class="form-control" id="exampleInputProductName" aria-describedby="nameProduct" placeholder="Enter Name Of Product" name="name_product">
                        <small id="nameHelp" class="form-text text-muted">Please write down the name of product here.</small><br><br>
                        <label for="ProductPrice">Price of Product</label>
                        <input type="text" class="form-control" id="exampleInputProductPrice" placeholder="Enter Product Price" name="price_product">
                        <small id="priceHelp" class="form-text text-muted">Please write down the price of product here.</small><br><br>

                        <label for="hotel">Choose Hotel Name:</label>
                        <select name="hotel_product" id="hotels">
                            @foreach ($hotel as $h)
                            <option value='{{$h->id}}'>{{$h->name}}</option>
                            @endforeach
                        </select>

                        <br><br>
                        <label for="ProductImage">Image of Product</label>
                        <input type="text" class="form-control" id="ProductImage" placeholder="Enter Image Of Product" name="image_product">
                        <small id="imageHelp" class="form-text text-muted">Please write down the image of product here.</small><br><br>

                        <label for="ProductAvailable">Available Room</label>
                        <input type="text" class="form-control" id="AvailableRoom" placeholder="Enter Total Available Room" name="available_room">
                        <small id="RoomHelp" class="form-text text-muted">Please write down the Total of Available Room here.</small><br><br>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditA" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">
            </div>
        </div>
    </div>
</div>

@section('js')
<script>
    function getEditForm(prod_id) {
        $.ajax({
            type: 'POST',
            url: '{{route("product.getEditForm")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': prod_id
            },
            success: function(data) {
                $('#modalContent').html(data.msg)
            }
        });
    }

    function deleteDataRemoveCard(prod_id) {
        $.ajax({
            type: 'POST',
            url: '{{route("product.deleteData")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': prod_id
            },
            success: function(data) {
                if (data.status == "oke") {
                    $('#card_' + prod_id).remove();
                }
            }
        });
    }
</script>
@endsection
@endsection