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
                                <a href="{{route('transaction.create')}}" class="btn btn-success">+ New Transaction</a>
                                <a href="#modalCreate" data-toggle="modal" class="btn btn-info">+ New Transaction (With Modals)</a>
                                <div class="container">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Pembeli</th>
                                                <th>Kasir</th>
                                                <th>Tanggal Transaction</th>
                                                <th>Action</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $d)
                                            <tr id="tr_{{$d->id}}">
                                                <td>{{$d->id}}</td>
                                                <td>{{$d->customer->name}}</td>
                                                <td>{{$d->user->name}}</td>
                                                <td>{{$d->transaction_date}}</td>
                                                <td>
                                                    <a class="btn btn-default" href="#myModal{{$d->id}}" data-toggle="modal">Lihat Rincian Pembelian</a>
                                                    <div class="modal fade" id="myModal{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                                                        <div class="modal-dialog modal-wide">
                                                            <div class="modal-content" id="msg">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nama Hotel</th>
                                                                            <th>Nama Produk</th>
                                                                            <th>Subtotal</th>
                                                                            <th>Quantity</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($d->products as $p)
                                                                        <tr>
                                                                            <td>{{$p->hotel->name}}</td>
                                                                            <td>{{$p->name}}</td>
                                                                            <td>{{$p->pivot->subtotal}}</td>
                                                                            <td>{{$p->pivot->quantity}}</td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @can('edit', $d)
                                                    <a class="btn btn-warning" href="{{route('transaction.edit',$d->id)}}">Edit</a>
                                                    <a class="btn btn-warning" href="#modalEditA" data-toggle="modal" onclick="getEditForm({{$d->id}})">Edit Type A</a>
                                                    @endcan
                                                </td>
                                                <td>
                                                    @can('delete', $d)
                                                    <form method="post" action="{{route('transaction.destroy',$d->id)}}">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="submit" value="Delete" onclick="return confirm('Are you sure?')" class="btn btn-danger"></input>
                                                    </form>
                                                    <a class="btn btn-danger" href="#" value="DeleteNoReload" onclick="if(confirm('Are you sure to delete {{$d->id}} ?')) deleteDataRemoveTR({{$d->id}})">Delete without reload</a>
                                                    @endcan                                                
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Side Bar End -->
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
                <h4 class="modal-title">Add New Transaction</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('transaction.store')}}">
                    @csrf
                    <div class="form-group">
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
                        <input type="text" class="form-control" id="quantityProduct" placeholder="Enter Quantity Of Product" name="quantity">
                        <small id="quantityHelp" class="form-text text-muted">Please write down the amount of quantity product.</small><br><br>

                        <label for="subtotal">Sub Total</label>
                        <input type="text" class="form-control" id="subtotalProduct" placeholder="Enter Sub Total" name="subtotal">
                        <small id="subtotalHelp" class="form-text text-muted">Please write down the SubTotal here.</small><br><br>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
    function getEditForm(trans_id) {
        $.ajax({
            type: 'POST',
            url: '{{route("transaction.getEditForm")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': trans_id
            },
            success: function(data) {
                $('#modalContent').html(data.msg)
            }
        });
    }

    function deleteDataRemoveTR(trans_id) {
        $.ajax({
            type: 'POST',
            url: '{{route("transaction.deleteData")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': trans_id
            },
            success: function(data) {
                if (data.status == "oke") {
                    $('#tr_' + trans_id).remove();
                }
            }
        });
    }
</script>
@endsection
