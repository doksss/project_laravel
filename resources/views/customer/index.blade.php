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
                                @can('delete-permission',Auth::user())
                                <a href="#modalCreate" data-toggle="modal" class="btn btn-info">+ New Customer</a>
                                @endcan
                                <div class="container">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Point</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $d)
                                            <tr>
                                                <td>{{$d->id}}</td>
                                                <td>{{$d->name}}</td>
                                                <td>{{$d->address}}</td>
                                                <td>{{$d->created_at}}</td>
                                                <td>{{$d->updated_at}}</td>
                                                <td>{{$d->point}}</td>
                                                @can('delete-permission',Auth::user())
                                                <td>
                                                    <!-- <a class="btn btn-warning" href="{{route('hotels.edit',$d->id)}}">Edit</a> -->
                                                    <div class="btn-group">
                                                        <a class="btn btn-warning" href="#modalEditA" data-toggle="modal" onclick="getEditForm({{$d->id}})">Edit</a>
                                                    </div>
                                                </td>


                                                <td>
                                                    <form method="post" action="{{route('hotels.destroy',$d->id)}}">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="submit" value="Delete" onclick="return confirm('Are you sure?')" class="btn btn-danger"></input>
                                                    </form>
                                                </td>
                                                @endcan
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
<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add New Customer</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('customer.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputCustName">Name of Customer</label>
                        <input type="text" class="form-control" id="exampleInputCustomerName" aria-describedby="nameCustomer" placeholder="Enter Name Of Customer" name="name_cust">
                        <small id="nameHelp" class="form-text text-muted">Please write down the name of customer here.</small><br><br>
                        <label for="exampleInputCustAddress">Address of Customer</label>
                        <input type="text" class="form-control" id="exampleInputCustomerAddress" aria-describedby="addressCustomer" placeholder="Enter Address Of Customer" name="address_cust">
                        <small id="addressHelp" class="form-text text-muted">Please write down the address of customer here.</small>
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
    function getEditForm(cust_id) {
        $.ajax({
            type: 'POST',
            url: '{{route("customer.getEditForm")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': cust_id
            },
            success: function(data) {
                $('#modalContent').html(data.msg)
            }
        });
    }

    function deleteDataRemoveTR(cust_id) {
        $.ajax({
            type: 'POST',
            url: '{{route("customer.deleteData")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': cust_id
            },
            success: function(data) {
                if (data.status == "oke") {
                    $('#tr_' + cust_id).remove();
                }
            }
        });
    }
</script>
@endsection
@endsection