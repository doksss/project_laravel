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
                                <a href="#"><img src="{{asset('images/kamarA.jpeg') }}" alt="Image"></a>
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
                        <td>{{ 'IDR '.$item['quantity'] * $item['price'] }}</td>
                        <td><a class="btn btn-danger" href="{{route('delFromCart',$item['id'])}}"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    @php
                    $total += $item['quantity'] * $item['price'];
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
<div class="col-lg-4">
    <div class="cart-page-inner">
        <div class="row">
            <div class="col-md-12">
                @if(session('cart'))
                <div class="point">
                    @php
                    $tax = 11/100 * $total;
                    $grandTotal = $total + $tax;
                    $point = Auth::user()->point;
                    if($total>=100000 && $point > 0){
                    @endphp
                    <button onclick="redeemPoints()" class="btn-minus"><i class="fa fa-minus"></i> Redeem points</button>
                    @php
                    }
                    @endphp
                    
                </div>
                @endif
            </div>
            <div class="col-md-12">
                <div class="cart-summary">
                    @if(session('cart'))
                    <div class="cart-content">
                        <h1>Cart Summary</h1>
                        <h4>Sub Total: <span id="subTotal">{{'IDR ' . $total}}</span></h4>

                        <h4>Tax: <span id="tax">{{'IDR ' . $tax}}</span></h4>
                        <h2>Grand Total: <span id="grandTotal">{{ 'IDR ' . $grandTotal }}</span></h2>
                    </div>
                    <div class="cart-btn">
                        <a class="btn btn-xs" href="{{ route('laralux.index') }}">Continue Shopping</a>
                        <a class="btn btn-xs" href="{{ route('checkout') }}">Checkout</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function redQty(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("redQty") }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'id': id
            },
            success: function(data) {
                location.reload();
            }
        });
    }

    function addQty(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("addQty") }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'id': id
            },
            success: function(data) {
                location.reload();
            }
        });
    }

    function redeemPoints() {
        $.ajax({
            type: 'POST',
            url: '{{ route("redeemPoints") }}',
            data: {
                '_token': '{{ csrf_token() }}'
            },
            success: function(data) {
                const total = data.total;
                const tax = 0.11 * total;
                const grandTotal = total + tax;

                $('#subTotal').text('IDR ' + total);
                $('#tax').text('IDR ' + tax.toFixed(2));
                $('#grandTotal').text('IDR ' + grandTotal.toFixed(2));
                alert('Points redeemed!');

                {{Auth::user()->point-1}}
            }
        });
    }
</script>
@endsection