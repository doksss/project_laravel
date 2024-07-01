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
                                                <td>
                                                    <a class="btn btn-warning" href="{{route('hotels.edit',$d->id)}}">Edit</a>
                                                </td>
                                                @can('delete-permission',Auth::user())
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