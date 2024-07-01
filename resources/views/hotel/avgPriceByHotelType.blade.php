
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Average Price</title>
  </head>
  <body>
  <h3>Average Price By Hotel Type</h3>
  <div class="card-group">
    
  @foreach($data as $d)
  <div class="card">
    <!-- <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/041.webp" class="card-img-top"
      alt="Hollywood Sign on The Hill" /> -->
    <div class="card-body">
      
      <h5 class="card-title">{{$d->name}}</h5>
      <p class="card-text">
        Type Hotel: {{$d->type_name}}
      </p>
      <p class="card-text">
        @if($d->avg_price == null)
        <small class="text-muted">Average Price: 0</small>
        @else
        <small class="text-muted">Average Price: {{$d->avg_price}} </small>
        @endif
      </p>
 
    </div>
  </div>
  @endforeach
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
<body>

<!-- <div class="container">
  <h2>REPORTING</h2>
  <p>Table Halaman Hotel Rivaldo(160421059)</p>            
  <table class="table">
    <thead>
      <tr>
        <th>Type</th>
        <th>Name</th>
        <th>avg_price</th>
      </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
      <tr>
        <td>{{$d->type_name}}</td>
        <td>{{$d->name}}</td>
        @if($d->avg_price == null)
          <td>0</td>
        @else
        <td>{{$d->avg_price}}</td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</body>
</html> -->
