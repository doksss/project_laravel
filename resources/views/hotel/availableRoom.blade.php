
<!DOCTYPE html>
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
        <th>Hotel ID</th>
        <th>Hotel Name</th>
        <th>Total Available Room(s)</th>
      </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
      <tr>
        <td>{{$d->id}}</td>
        <td>{{$d->name}}</td>
        <td>{{$d->room}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <!-- Kalo mau buat baru <a href="{{ route ('hotels.create') }}">Silahkan Kesini</a> -->
</div>

</body>
</html>
