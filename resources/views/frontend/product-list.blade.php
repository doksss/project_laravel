@extends('layout.frontend')
@section('content')

<div class="product-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-12">
                        <!-- @if(@session('status'))
                        <div class="alert alert-success">{{session('status')}}</div>
                        @endif -->
                        <h4>All Product Hotels</h4>
                        @can('delete-permission',Auth::user())
                        <a href="#modalCreate" data-toggle="modal" class="btn btn-info">+ New Product</a>
                        @endcan
                    </div>

                    @foreach($products as $p)
                    <div class="col-md-4" id="card_{{$p->id}}">
                        <div class="product-item">
                            <div class="product-title">
                                <a href="{{route('laralux.show',$p->id)}}">{{$p->name}}</a>
                            </div>
                            <div class="product-image">
                                <a href="product-detail.html">
                                    @if($p->filenames)
                                    @foreach ($p->filenames as $filename)
                                    <img src="{{asset('products/'.$p->id.'/'.$filename)}}" /><br>
                                    @endforeach
                                    @endif
                                    <h5>Tipe : {{$p->typeproduct->nama_tipe}}</h5>
                                </a>
                                <div class="product-action">
                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="{{ url('product/uploadPhoto/'.$p->id) }}"><i class="fa fa-image"></i></a>
                                    @can('delete-permission',Auth::user())
                                    <a href="#" value="DeleteNoReload" onclick="if(confirm('Are you sure to delete {{$p->id}} - {{$p->name}} ?')) deleteDataRemoveCard({{$p->id}})"><i class="fa fa-trash"></i></a>
                                    @endcan
                                </div>
                            </div>
                            <div class="product-price">
                                <h3><span>Rp.</span>{{$p->price}}</h3>
                                <a class="btn" href="{{route('addCart',$p->id)}}"><i class="fa fa-shopping-cart"></i>Cart</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add New Product</h4>
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
                        </select><br><br>

                        <label for="hotel">Choose Type of Product:</label>
                        <select name="typeproduct" id="typeproducts">
                            @foreach ($typeproduct as $tp)
                            <option value='{{$tp->id}}'>{{$tp->nama_tipe}}</option>
                            @endforeach
                        </select>

                        <br><br>

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
<script>
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