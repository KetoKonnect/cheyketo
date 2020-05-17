@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            <div class="card">
                <div class="card-header">Orders</div>
                @if($orders->count() >= 0)
                    <ul class="list-group">
                        @foreach ($orders as $order)
                    <a href="{{route('user.viewOrder', $order->id)}}" class="list-group-item list-group-item-action">
                            <h5>Order ID: {{$order->id}}</h5>
                            Total: ${{$order->total}}<br>
                            Status: {{$order->status}}<br>
                            Created At: {{$order->created_at}}
                            </a>
                        @endforeach
                    </ul>
                @else
                <div class="card-body">
                    You have not orderd any thing.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
