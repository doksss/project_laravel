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
                                <a href="#modalCreate" data-toggle="modal" class="btn btn-info">+ New Hotel</a>
                                @endcan
                                <div class="container">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama Hotel</th>
                                                <th>Alamat Hotel</th>
                                                <th>Nomor Telepon</th>
                                                <th>Email</th>
                                                <th>Rating Hotel</th>
                                                <th>Tipe Hotel</th>
                                                <th>Detail Products</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $d)
                                            <tr>
                                                <td>{{$d->name}}</td>
                                                <td>{{$d->address}}</td>
                                                <td>{{$d->nomor_telepon}}</td>
                                                <td>{{$d->email}}</td>
                                                <td>{{$d->rating_hotel}}</td>
                                                <td>{{$d->type->name}}</td>
                                                <td>
                                                    <a class="btn btn-warning" href="{{route('hotels.edit',$d->id)}}">Detail Product</a>
                                                </td>
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
    @endsection

    <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add New Hotel</h4>
                </div>
                <div class="modal-body">
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
                url: '{{route("hotel.getEditForm")}}',
                data: {
                    '_token': '<?php echo csrf_token() ?>',
                    'id': prod_id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            });
        }
    </script>
    @endsection