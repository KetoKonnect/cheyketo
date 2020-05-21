@extends('layouts.admin')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success')}}
    </div>
    @endif
    <div class="row mb-2">
        <div class="col">
<a href="{{ route('admin.allOrders')}}" class="btn btn-outline-secondary">
            <i class="fas fa-step-backward"></i>
            All Orders</a>
        </div>

    </div>

    <div class="d-flex w-100 justify-content-between">
        <h2>Order ID: {{ $order->id }}
        </h2>
        <h4>status: <span class="text-info">{{ $order->status }}</span> </h4>
    </div>
    <div class="row">
        <div class="col mb-3">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Change status to:</h4>
                </div>
                <div class="list-group ">
                <a href="{{ route('admin.updateOrderStatus', ['order' =>$order->id, 'status' => 'new'])}}" class="list-group-item list-group-item-action active">
                        New
                    </a>
                    <a href="{{ route('admin.updateOrderStatus', ['order' =>$order->id, 'status' => 'processing'])}}" class="list-group-item list-group-item-action ">
                        Processing
                    </a>
                    <a href="{{ route('admin.updateOrderStatus', ['order' =>$order->id, 'status' => 'ready'])}}" class="list-group-item list-group-item-action ">
                        Ready and available
                    </a>
                    <a href="{{ route('admin.updateOrderStatus', ['order' =>$order->id, 'status' => 'closed_fullfilled'])}}" class="list-group-item list-group-item-action ">
                        Closed (Fullfilled)
                    </a>
                    <a href="{{ route('admin.updateOrderStatus', ['order' =>$order->id, 'status' => 'closed_unfullfilled'])}}" class="list-group-item list-group-item-action ">
                        Closed (Unfullfilled)
                    </a>
                </div>
            </div>

        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Customer Details</h5>
                    <ul>
                        <li>{{ $order->user->name }}</li>
                        <li>{{ $order->user->phone_number }}</li>
                        <li> {{ $order->user->email }}</li>
                    </ul>
                </div>
            </div>
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

    <div class="row">

    </div>

</div>
@endsection
