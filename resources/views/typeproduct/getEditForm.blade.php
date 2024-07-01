<form method="post" action="{{route('typeproduct.update',$data->id)}}">
    @csrf
    @method('put')
  <div class="form-group">
    <label for="exampleInputType">Name of Type</label>
    <input type="text" class="form-control" id="eName" aria-describedby="nameHelp" placeholder="Enter Name Of Type" name="type_name" 
    value="{{$data->nama_tipe}}">
    <small id="nameHelp" class="form-text text-muted">Please write down the name of type here.</small><br><br>
  </div>
  <button type="button" class="btn btn-primary" onclick="saveDataUpdateTD({{$data->id}})">Update</button>
</form>