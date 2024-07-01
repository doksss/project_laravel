@extends('layout.conquer')
@section('content')
@if(@session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif
<a href="{{route('customer.create')}}" class="btn btn-success">+ New Customer</a>
<a href="#modalCreate" data-toggle="modal" class="btn btn-info">+ New Customer (With Modals)</a>
<h2>Daftar Customer</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr id="tr_{{$d->id}}">
            <td>{{$d->id}}</td>
            <td>{{$d->name}}</td>
            <td>{{$d->address}}</td>
            <td>{{$d->created_at}}</td>
            <td>{{$d->updated_at}}</td>
            <td>
                <a class="btn btn-warning" href="{{route('customer.edit',$d->id)}}">Edit</a>
                <a class="btn btn-warning" href="#modalEditA" data-toggle="modal" onclick="getEditForm({{$d->id}})">Edit Type A</a>
            </td>
            <td>
                <form method="post" action="{{route('customer.destroy',$d->id)}}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete" onclick="return confirm('Are you sure?')" class="btn btn-danger"></input>
                </form>
                <a class="btn btn-danger" href="#" value="DeleteNoReload" onclick="if(confirm('Are you sure to delete {{$d->id}} - {{$d->name}} ?')) deleteDataRemoveTR({{$d->id}})">Delete without reload</a>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>

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
    function getEditForm(cust_id)
    {
        $.ajax({
            type:'POST',
            url:'{{route("customer.getEditForm")}}',
            data:{
                '_token' : '<?php echo csrf_token() ?>',
                'id': cust_id
            },
            success: function(data){
                $('#modalContent').html(data.msg)
            }
        });
    }

    function deleteDataRemoveTR(cust_id)
    {
        $.ajax({
            type:'POST',
            url:'{{route("customer.deleteData")}}',
            data:{
                '_token' : '<?php echo csrf_token() ?>',
                'id': cust_id
            },
            success: function(data){
                if(data.status=="oke"){
                    $('#tr_'+cust_id).remove();
                }
            }
        });
    }

</script>
@endsection
@endsection