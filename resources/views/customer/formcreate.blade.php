<!-- Extends ini file blade php mau ditempel ke mana -->
@extends('layout.conquer')
@section('content')
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
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection