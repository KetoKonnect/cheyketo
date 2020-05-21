@extends('layouts.admin')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.allProducts') }}">All Products</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $product->name}}</li>
        </ol>
      </nav>
    <div class="row">
        <div class="col">

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())

            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img class="img-thumbnail" src="{{ asset($product->thumbnail) }}">
                        </div>
                        <div class="col">
                            <div>
                                <h4>{{ $product->name }}</h4>
                                <ul>
                                    <li>
                                        Quantity Available: {{ $product->qty }}
                                    </li>
                                    <li>
                                        Quantity Sold: {{$product->quantity_sold}}
                                    </li>
                                    <li>
                                        Price: ${{ $product->price }}
                                    </li>
                                    <li>
                                        Description <br>
                                        {{ $product->description }}
                                    </li>
                                </ul>
                            </div>
                            <div>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-block">Edit</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
