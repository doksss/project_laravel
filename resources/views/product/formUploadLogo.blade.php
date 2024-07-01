@extends('layout.frontend')
@section('content')

<div class="product-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">

                    <div class="col-md-4">
                        <form method="POST" enctype="multipart/form-data" action="{{url('product/simpanPhoto')}}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputType">Pilih Logo</label>
                                <input type="file" class="form-control" name="file_photo" />
                                <input type="hidden" name='product_id' value="{{$product->id}}" />
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection