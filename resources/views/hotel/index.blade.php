<!-- Extends ini file blade php mau ditempel ke mana -->
@extends('layout.conquer')
@section('content')
@if(@session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif
<h1>Home Laralux</h1>
<br>
<a href="{{route('hotels.create')}}" class="btn btn-success">+ New Hotel</a><br><br><br>
<!-- BUTTON MUNCULKAN MODAL -->
<!-- <a class="btn btn-warning" data-toggle="modal" href="#disclaimer">Disclaimer!</a> -->
<!-- END BUTTON MUNCULKAN MODAL -->

<!-- MODAL -->
<!-- yg penting itu class modal fade dan id(ikutin button) -->
<!-- <div class="modal fade" id="disclaimer" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">DISCLAIMER</h4>
      </div>
      <div class="modal-body">
        Pictures shown are for illustration purpose only. Actual product may vary due to product enhancement.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->
<!-- END MODAL -->

<!-- <ul>
  @foreach($data as $d)
  <li>
    {{$d->name}}
  </li>
  @endforeach
</ul> -->

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
          <a class="btn btn-info" href="#detail_{{$d->id}}" data-toggle="modal">{{ $d->name }}</a>

          <div class="modal fade" id="detail_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">{{$d->name}}</h4>
                </div>
                <div class="modal-body">
                  <img src="{{ asset($d->image)}}" height='200px' />
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
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
  <!-- Kalo mau buat baru <a href="{{ route ('hotels.create') }}">Silahkan Kesini</a> -->
</div>
@endsection

<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <title>Page Hotels</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Halaman Index Hotel</h2>
  <p>Table Halaman Hotel Rivaldo(160421059)</p>            
  <table class="table">
    <thead>
      <tr>
        <th>Nama Hotel</th>
        <th>Alamat Hotel</th>
        <th>Kota Hotel</th>
        <th>Created At</th>
        <th>Update At</th>
      </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
      <tr>
        <td>{{$d->name}}</td>
        <td>{{$d->address}}</td>
        <td>{{$d->city}}</td>
        <td>{{$d->created_at}}</td>
        <td>{{$d->update_at}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  Kalo mau buat baru <a href="{{ route ('hotels.create') }}">Silahkan Kesini</a>
</div>

</body>
</html> -->