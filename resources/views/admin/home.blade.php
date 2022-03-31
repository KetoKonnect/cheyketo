@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h1 class="m-5">
                            <!-- <router-link to="/products">Products</router-link> -->
                        <a href="{{ route('admin.allProducts')}}">
                                <i class="fas fa-tags"></i>
                                Products
                            </a>
                        </h1>
                        <p>Total: {{$productCount}}</p>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h1 class="m-5">
                            <!-- <router-link>Orders</router-link> -->
                        <a href="{{ route('admin.allOrders')}}">
                                <i class="fas fa-file-invoice-dollar"></i>
                                Orders
                            </a>
                        </h1>
                        <p>Total: {{$ordersCount}} New: {{$newOrders}}</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h1 class="m-5">
                            <!-- <router-link>Orders</router-link> -->
                            <a href="{{ route('admin.categories.index')}}">
                                <i class="fas fa-file-invoice-dollar"></i>
                                Categories
                            </a>
                        </h1>
                    </div>

                </div>     
            </div>
        </div>
    </div>
@endsection
