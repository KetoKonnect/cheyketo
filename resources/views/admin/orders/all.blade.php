@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>All Orders</h2>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date Placed</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->user->name}}</td>
                                        <td>${{$order->total}}</td>
                                        <td>{{$order->status}}</td>
                                        <td>{{$order->created_at->toFormattedDateString()}}</td>
                                        <td>
                                            <a href="{{route('admin.viewOrder', $order->id)}}" class="btn btn-outline-secondary">
                                                view
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
