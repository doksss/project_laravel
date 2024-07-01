@extends('layout.frontend')
@section('content')
<div class="col-lg-8">
    <div class="cart-page-inner">
        <div class="table-responsive">
            @php
            $total = 0;
            @endphp
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @if(session('cart'))
                    @foreach (session('cart') as $item)
                    <tr>
                        <td>
                            <div class="img">
                                @if ($item['photo'] == NULL)
                                <a href="#"><img src="{{asset('images/blank.jpg') }}" alt="Image"></a>
                                @else
                                <a href="#"><img src="{{asset('images/'.$item['photo']) }}" alt="Image"></a>
                                @endif
                                <p>{{$item['name']}}</p>
                            </div>
                        </td>
                        <td>{{'IDR '.$item['price']}}</td>
                        <td>
                            <div class="qty">
                                <button onclick="redQty({{$item['id']}})" class="btn-minus"><i class="fa fa-minus"></i></button>
                                <input type="text" value="{{ $item['quantity'] }}">
                                <button onclick="addQty({{$item['id']}})" class="btn-plus"><i class="fa fa-plus"></i></button>
                            </div>
                        </td>
                        <td>{{ 'IDR '.$item['quantity']* $item['price'] }}</td>
                        <td><a class="btn btn-danger" href="{{route('delFromCart',$item['id'])}}"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    @php
                    $total+= $item['quantity']* $item['price'];
                    @endphp
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5">
                            <p>Tidak ada item di cart.</p>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection