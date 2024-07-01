@extends('layout.conquer')
@section('content')

@if(@session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<a href="{{route('type.create')}}" class="btn btn-success">+ New Type</a>
<a href="#modalCreate" data-toggle="modal" class="btn btn-info">+ New Type (With Modals)</a>



<table class="table">
    <thead>
        <tr>
            <th>Nama Type</th>
            <th>Description</th>
            <th>Date Created</th>
            <th>Date Update</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr id="tr_{{$d->id}}">
            <td id="td_name_{{$d->id}}">{{$d->name}}</td>            
            <td>{{$d->description}}</td>
            <td>{{$d->created_at}}</td>
            <td>{{$d->updated_at}}</td>
            <td>
                <a class="btn btn-warning" href="{{route('type.edit',$d->id)}}">Edit</a>
                <a class="btn btn-warning" href="#modalEditA" data-toggle="modal" onclick="getEditForm({{$d->id}})">Edit Type A</a>
                <a class="btn btn-info" href="#modalEditB" data-toggle="modal" onclick="getEditFormB({{$d->id}})">Edit Type B</a>
                <a class="btn btn-danger" href="#" value="DeleteNoReload" onclick="if(confirm('Are you sure to delete {{$d->id}} - {{$d->name}} ?')) deleteDataRemoveTR({{$d->id}})">Delete without reload</a>
            </td>
        </tr>
        @endforeach
    
    </tbody>
</table>

@section('js')
<script>
    function getEditForm(type_id)
    {
        $.ajax({
            type:'POST',
            url:'{{route("type.getEditForm")}}',
            data:{
                '_token' : '<?php echo csrf_token() ?>',
                'id': type_id
            },
            success: function(data){
                $('#modalContent').html(data.msg)
            }
        });
    }

    function getEditFormB(type_id)
    {
        $.ajax({
            type:'POST',
            url:'{{route("type.getEditFormB")}}',
            data:{
                '_token' : '<?php echo csrf_token() ?>',
                'id': type_id
            },
            success: function(data){
                $('#modalContentB').html(data.msg)
            }
        });
    }

    function saveDataUpdateTD(type_id)
    {
        var eName = $('#eName').val()
        console.log(eName)
        $.ajax({
            type:'POST',
            url:'{{route("type.saveDataTD")}}',
            data:{
                '_token' : '<?php echo csrf_token() ?>',
                'id': type_id,
                'name':eName
            },
            success: function(data){
                if(data.status=="oke"){
                    $('#td_name_'+ type_id).html(eName);
                    $('#modalEditB').modal('hide');

                }
                
            }
        });
    }

    function deleteDataRemoveTR(type_id)
    {
        $.ajax({
            type:'POST',
            url:'{{route("type.deleteData")}}',
            data:{
                '_token' : '<?php echo csrf_token() ?>',
                'id': type_id
            },
            success: function(data){
                if(data.status=="oke"){
                    $('#tr_'+type_id).remove();
                }
            }
        });
    }

</script>
@endsection

<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add New Type</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('type.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputType">Name of Type</label>
                        <input type="text" class="form-control" id="exampleInputType" aria-describedby="nameHelp" placeholder="Enter Name Of Type" name="type_name">
                        <small id="nameHelp" class="form-text text-muted">Please write down the name of type here.</small><br><br>
                        <label for="descInput">Description of Type</label>
                        <input type="text" class="form-control" id="descInput" aria-describedby="descHelp" placeholder="Enter Description Of Type" name="type_desc">
                        <small id="descHelp" class="form-text text-muted">Please write down the description of type here.</small>
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

<div class="modal fade" id="modalEditB" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content"> 
            <div class="modal-body" id="modalContentB">
            </div>
        </div>
    </div>
</div>

@endsection