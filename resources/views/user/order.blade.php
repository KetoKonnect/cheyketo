@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col">
<a href="{{ route('user.orders')}}" class="btn btn-outline-secondary">
            <i class="fas fa-step-backward"></i>
            My Orders</a>
        </div>

    </div>

    <div class="d-flex w-100 justify-content-between">
        <h2>Order ID: {{ $order->id }}
        </h2>
        <h4>status: <span class="text-info">{{ $order->status }}</span> </h4>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                <h5>Payment Method: <span class="text-info">{{ $order->payment_method }}</span></h5>
                </div>
                <ul class="list-group">
                    @foreach ($order->line_items as $item)
                        <li class="list-group-item d-flex w-100 ">
                        <img class="img-thumbnail mr-2" src="{{ asset(App\Product::find($item->id)->thumbnail) }}" style="max-width: 100px;">
                            <div>
                                <h5>{{ $item->name }}</h5>
                                {{ $item->description }} <br>
                                Qty {{ $item->quantity }} &times; ${{ $item->price }} = ${{ number_format(($item->quantity * $item->price), 2, '.', ',') }}
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="card-footer">
                    <h4>Subtotal: ${{ $order->subtotal }}</h4>
                <h3>Total: ${{ $order->total }}</h3>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
