<form method="post" action="{{route('type.update',$data->id)}}">
    @csrf
    @method('put')
  <div class="form-group">
    <label for="exampleInputType">Name of Type</label>
    <input type="text" class="form-control" id="eName" aria-describedby="nameHelp" placeholder="Enter Name Of Type" name="type_name" 
    value="{{$data->name}}">
    <small id="nameHelp" class="form-text text-muted">Please write down the name of type here.</small><br><br>
    <label for="descInput">Description of Type</label>
    <input type="text" class="form-control" id="descInput" aria-describedby="descHelp" placeholder="Enter Description Of Type" name="type_desc" 
    value="{{$data->description}}">
    <small id="descHelp" class="form-text text-muted">Please write down the description of type here.</small>
  </div>
  <button type="button" class="btn btn-primary" onclick="saveDataUpdateTD({{$data->id}})">Update</button>
</form>