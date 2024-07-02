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
                                                <th>Product Name</th>
                                                <th>Facility Name</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $productFacility)
                                                @if ($key == 0 || $productFacility->product->name != $data[$key - 1]->product->name)
                                                    <tr>
                                                        <td rowspan="{{ $data->where('product_id', $productFacility->product_id)->count() }}">
                                                            {{ $productFacility->product->name }}
                                                        </td>
                                                        <td>{{ $productFacility->facility->nama }}</td>
                                                        <td>{{ $productFacility->facility->deskripsi }}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>{{ $productFacility->facility->nama }}</td>
                                                        <td>{{ $productFacility->facility->deskripsi }}</td> 
                                                    </tr>
                                                @endif
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
</div>
@endsection
